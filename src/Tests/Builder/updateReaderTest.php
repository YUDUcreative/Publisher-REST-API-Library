<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class updateReaderTest extends PublisherTestCase
{
    public function testUpdateReaderXML()
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

        $xml = XMLBuilder::updateReader(1, $data);

        $expected = simplexml_load_file(__DIR__ . '/xml/updateReader.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

