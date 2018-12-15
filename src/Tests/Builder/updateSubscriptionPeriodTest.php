<?php

namespace Bibby\Publisher\Tests\Builder;

use Bibby\Publisher\Tests\PublisherTestCase;
use Bibby\Publisher\XMLBuilder;

class updateSubscriptionPeriodTest extends PublisherTestCase
{
    public function testUpdateSubscriptionPeriodXML()
    {
        $data = [
            'startDate'    => '2014-11-01T00:00:00Z',
            'expiryDate'   => '2016-11-01T00:00:00Z',
        ];

        $xml = XMLBuilder::updateSubscriptionPeriod(1, $data);

        $expected = simplexml_load_file(__DIR__ . '/xml/updateSubscriptionPeriod.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        $this->assertEquals($xml, $expected->asXML());
    }
}

