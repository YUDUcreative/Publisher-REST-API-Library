<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class createPermissionTest extends PublisherTestCase
{
    public function testCreatePermissionXML()
    {
        $data = [
            'reader'  => '12345',
            'edition' => '64256',
        ];

        $xml = XMLBuilder::createPermission($data);

        $expected = simplexml_load_file(__DIR__ . '/xml/createPermission.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

