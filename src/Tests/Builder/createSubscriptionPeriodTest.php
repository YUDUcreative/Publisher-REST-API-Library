<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class createSubscriptionPeriodTest extends PublisherTestCase
{
    public function testCreateSubscriptionPeriodXML()
    {
        $data = [
            'reader'       => '1234',
            'subscription' => '9876',
            'startDate'    => '2014-11-01T00:00:00Z',
            'expiryDate'   => '2016-11-01T00:00:00Z',
        ];

        $xml = XMLBuilder::createSubscriptionPeriod($data);

        $expected = simplexml_load_file(__DIR__ . '/xml/createSubscriptionPeriod.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

