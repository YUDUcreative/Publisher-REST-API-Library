<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class updateReaderTest extends PublisherTestCase
{
    public function testUpdateReaderXML()
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

        $xml = XMLBuilder::updateReader(1, $data);

        $expected = $this->loadXML('updateReader');

        $this->assertEquals($xml, $expected);
    }
}

