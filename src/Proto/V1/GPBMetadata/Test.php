<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: test.proto

namespace GPBMetadata;

class Test
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
C

test.protov1"
TestMessage
name (	B�	TestProtobproto3'
        , true);

        static::$is_initialized = true;
    }
}

