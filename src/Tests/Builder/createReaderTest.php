<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class createReaderTest extends PublisherTestCase
{
    public function testCreateReaderXML()
    {
        $data = [
            'emailAddress'          => 'user@example.com',
            'username'              => 'example',
            'firstName'             => 'example',
            'lastName'              => 'user',
            'nodeId'                => '12345',
            'password'              => 'secret',
            'authorisedDeviceLimit' => '3',
        ];

        $xml = XMLBuilder::createReader($data);

        $expected = $this->loadXML('createReader');

        $this->assertEquals($xml, $expected);
    }
}

