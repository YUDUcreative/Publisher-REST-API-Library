<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class updatePermissionTest extends PublisherTestCase
{
    public function testUpdatePermissionXML()
    {
        $data = [
            'expiryDate'  => '2015-06-01T00:00:00Z',
        ];

        $xml = XMLBuilder::updatePermission(1, $data);

        $expected = simplexml_load_file(__DIR__ . '/xml/updatePermission.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

