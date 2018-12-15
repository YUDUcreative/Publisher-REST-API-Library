<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class createReaderTest extends PublisherTestCase
{
    public function testCreateReaderXML()
    {
        $data = [
            'username'              => 'example',
            'emailAddress'          => 'user@example.com',
            'firstName'             => 'example',
            'lastName'              => 'user',
            'nodeId'                => '12345',
            'password'              => 'secret',
            'authorisedDeviceLimit' => '3',
        ];

        $xml = XMLBuilder::createReader($data);

        $expected = simplexml_load_file(__DIR__ . '/xml/createReader.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

