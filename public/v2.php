<?php

require_once __DIR__ . '/../src/Proto/V2/GPBMetadata/Test.php';
require_once __DIR__ . '/../src/Proto/V2/TestProto/TestMessage.php';

use TestProto\TestMessage;

$v2 = new TestMessage();
$v2->setId(123);
$v2->setName('Version 2');

header('Content-Type: text/plain');
echo "--- V2 Request ----\n";
echo "V2 Message ID: " . $v2->getId() . "\n";
echo "V2 Message Name: " . $v2->getName() . "\n";
echo "V2 Message Class: " . get_class($v2) . "\n\n";

echo "--- Descriptor Pool State ---\n";
$pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
echo "Pool object ID: " . spl_object_hash($pool) . "\n";

echo "Checking for descriptors:\n";
echo "v1.TestMessage: ";
var_dump($pool->getDescriptorByProtoName('v1.TestMessage') !== null);
echo "v2.TestMessage: ";
var_dump($pool->getDescriptorByProtoName('v2.TestMessage') !== null);
