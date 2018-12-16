<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class createTokenTest extends PublisherTestCase
{
    public function testCreateTokenXML()
    {
        $xml = XMLBuilder::createToken('user12345');

        $expected = $this->loadXML('createToken');

        $this->assertEquals($xml, $expected);
    }
}

