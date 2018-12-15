<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class authenticatePasswordTest extends PublisherTestCase
{
    public function testAuthenticatePasswordXML()
    {

        $xml = XMLBuilder::authenticatePassword('%$Rfdg_)ka,Ki');

        $expected = simplexml_load_file(__DIR__ . '/xml/authenticatePassword.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

