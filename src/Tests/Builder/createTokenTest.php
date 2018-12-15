<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class createTokenTest extends PublisherTestCase
{
    public function testCreateTokenXML()
    {
        $xml = XMLBuilder::createToken('user12345');

        $expected = simplexml_load_file(__DIR__ . '/xml/createToken.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

