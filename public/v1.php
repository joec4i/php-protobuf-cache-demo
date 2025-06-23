<?php

require_once __DIR__ . '/../src/Proto/V1/GPBMetadata/Test.php';
require_once __DIR__ . '/../src/Proto/V1/TestProto/TestMessage.php';

use TestProto\TestMessage;

$v1 = new TestMessage();
$v1->setName('Version 1');

header('Content-Type: text/plain');
echo "--- V1 Request ----\n";
echo "V1 Message Name: " . $v1->getName() . "\n";
echo "V1 Message Class: " . get_class($v1) . "\n\n";

echo "--- Descriptor Pool State ---\n";
$pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
echo "Pool object ID: " . spl_object_hash($pool) . "\n";

echo "Checking for descriptors:\n";
echo "v1.TestMessage: ";
var_dump($pool->getDescriptorByProtoName('v1.TestMessage') !== null);
echo "v2.TestMessage: ";
var_dump($pool->getDescriptorByProtoName('v2.TestMessage') !== null);
