# PHP Protobuf Descriptor Pool Cache Behaviour Demonstration

## Purpose

This Proof of Concept demonstrates a conflict in the PHP Protobuf C extension's descriptor pool. The conflict occurs when
* `protobuf.keep_descriptor_pool_after_request` is enabled
* multiple versions of a Protobuf message share the same fully-qualified PHP class name
* different versions of the message are used within the same PHP-FPM environment.

This is because the descriptor pool cache is keyed by [the fully-qualified PHP class name](https://github.com/protocolbuffers/protobuf/blob/20a975647ad082f9f7dd202c8664c66b81abff61/php/ext/google/protobuf/protobuf.c#L223-L225), rather than the PHP file path.
As a result, different versions of the same message share the same descriptor pool, leading to the conflict.

## Setup & Run

**Prerequisites:** Docker

```sh
docker-compose up -d --build
```

## How to Demonstrate the Conflict

1.  **First, open the V1 endpoint:** [http://localhost:8880/v1.php](http://localhost:8880/v1.php). You will see a successful response, showing the V1 descriptor is loaded.
```
--- V1 Request ----
V1 Message Name: Version 1
V1 Message Class: TestProto\TestMessage

--- Descriptor Pool State ---
Pool object ID: 00000000000000040000000000000000
Checking for descriptors:
v1.TestMessage: bool(true)
v2.TestMessage: bool(false)
```

2.  **Next, open the V2 endpoint:** [http://localhost:8880/v2.php](http://localhost:8880/v2.php). You will see a **Fatal error**.
    > Fatal error: Uncaught Exception: No such property TestProto\TestMessage. in /var/www/html/src/Proto/V2/TestProto/TestMessage.php:57 Stack trace: #0 /var/www/html/public/v2.php(9): TestProto\TestMessage->setId(123) #1 {main} thrown in /var/www/html/src/Proto/V2/TestProto/TestMessage.php on line 57

## Conclusion

This fatal error confirms that it is not possible to enable the Protobuf descriptor cache when multiple versions of the same message class need to run in the same PHP-FPM environment.
