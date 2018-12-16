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

        $expected = $this->loadXML('createPermission');

        $this->assertEquals($xml, $expected);
    }
}

