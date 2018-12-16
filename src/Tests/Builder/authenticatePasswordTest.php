<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class authenticatePasswordTest extends PublisherTestCase
{
    public function testAuthenticatePasswordXML()
    {
        $xml = XMLBuilder::authenticatePassword('%$Rfdg_)ka,Ki');

        $expected = $this->loadXML('authenticatePassword');

        $this->assertEquals($xml, $expected);
    }
}

