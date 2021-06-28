<?php

namespace ReviewPack\Tests\ValueObjects;

use PHPUnit\Framework\TestCase;
use ReviewPack\ValueObjects\ReferenceCollection;

/**
 * Class ReferenceCollectionTest
 * @package ReviewPack\Tests\ValueObjects
 */
class ReferenceCollectionTest extends TestCase
{

    public function testClassExists()
    {
        $this->assertTrue(\class_exists(ReferenceCollection::class));
    }

    public function testReferenceConstructor()
    {
        $collection = new ReferenceCollection('test', 'test2', 'test3');

        $this->assertEquals([
            'test', 'test2', 'test3'
        ], $collection->getReferences());
    }

    public function testGetFirstReference()
    {
        $collection = new ReferenceCollection('test', 'test2', 'test3');

        $this->assertEquals('test', $collection->getFirstReference());
    }

    public function testGetSecondReference()
    {
        $collection = new ReferenceCollection('test', 'test2', 'test3');

        $this->assertEquals('test2', $collection->getSecondReference());
    }

    public function testGetThirdReference()
    {
        $collection = new ReferenceCollection('test', 'test2', 'test3');

        $this->assertEquals('test3', $collection->getThirdReference());
    }

    public function testGetFourthReference()
    {
        $collection = new ReferenceCollection('test', 'test2', 'test3');

        $this->assertEquals(null, $collection->getFourthReference());
    }

    public function testGetFifthReference()
    {
        $collection = new ReferenceCollection('test', 'test2', 'test3');

        $this->assertEquals(null, $collection->getFifthReference());
    }

}