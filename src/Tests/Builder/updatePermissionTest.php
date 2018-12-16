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

        $expected = $this->loadXML('updatePermission');

        $this->assertEquals($xml, $expected);
    }
}

