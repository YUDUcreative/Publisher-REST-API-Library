<?php

namespace Bibby\Publisher\Tests;

use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use Bibby\Publisher\Publisher;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Client;

class PublisherTestCase extends TestCase {

    /**
     * Test API Key
     */
    const KEY = "tysH8MggNaxfMC4Sz5KheccAKvkTkKoXXPcaeKKw98658OchyEK1iCH6vTsJuhhq";

    /**
     * Test API Secret
     */
    const SECRET = "ts6awAsGfZ5HaDzKmxjb3v5bn2K0lWcJCcckrPwEUj2d0ILWLNtKO7NZ7dOISkYU";

    /**
     * Expected Request Content Type
     */
    const CONTENT_TYPE  = "application/vnd.yudu+xml";

    /**
     * Publisher API Base Service URL
     */
    const SERVICE_URL = "https://api.yudu.com/Yudu/services/2.0/";

    /**
     * Request Timestamp
     * Timestamp fixed to ensure testable signatures
     */
    CONST TIMESTAMP = '1245932460'; // 06/25/2009 @ 12:21pm RIP

    /**
     * History
     *
     * History of all mocked guzzle requests
     * @var array
     */
    public $history = [];

    /**
     * Build Publisher Client
     *
     * Instantiates a publisher client for use in testing
     * Mock Guzzle is passed to prevent real api calls.
     * @return \Bibby\Publisher\Publisher
     * @throws \Exception
     */
    protected function buildPublisherClient($options = [])
    {
        $options['timestamp'] = self::TIMESTAMP;
        return new Publisher(self::KEY, self::SECRET, $options, $this->mockGuzzleClient());
    }

    /**
     * Mock Guzzle Client
     *
     * Creates a mocked guzzle client with history middleware
     * All requests/responses are logged in $history
     * @return \GuzzleHttp\Client
     */
    public function mockGuzzleClient()
    {
        // Create guzzle mock handler
        $mock = new MockHandler([ new Response(200, []) ]);

        // Create handler stack
        $stack = HandlerStack::create($mock);
        $stack->push( Middleware::history($this->history));

        // Create mock guzzle client
        return  new Client(['handler' => $stack]);
    }

    /**
     * Gets the Request Uri from Guzzle history
     */
    public function getRequestUri()
    {
        return $this->history[0]['request']->getUri()->__toString();
    }

    /**
     * Gets the Request Authentication Header
     */
    public function getRequestAuthentication()
    {
        return $this->history[0]['request']->getHeaders()['Authentication'][0];
    }

    /**
     * Gets the Request Content Type Header
     */
    public function getRequestContentType()
    {
        return $this->history[0]['request']->getHeaders()['Content-Type'][0];
    }

    /**
     * Gets the Request Signature Header
     */
    public function getRequestSignature()
    {
        return $this->history[0]['request']->getHeaders()['Signature'][0];
    }

    /**
     * Gets the Request Body
     */
    public function getRequestBody()
    {
        return $this->history[0]['request']->getBody()->getContents();
    }

    /**
     * Gets the Request Method from Guzzle history
     */
    public function getRequestMethod()
    {
        return $this->history[0]['request']->getMethod();
    }

    /**
     * Load XML File
     *
     * @param $file
     * @return XML string
     */
    protected function loadXML($file)
    {
        $file =  __DIR__ . '/Publisher/xml/' . $file . '.xml';
        $xml = simplexml_load_file($file, 'SimpleXMLElement', LIBXML_NOBLANKS);
        return $xml->asXML();
    }

    /**
     * Confirms Request
     *
     * This method makes a number of assertions to confirm the headers
     * and other data are passed to guzzle exactly as expected
     * @param array $expected
     */
    protected function confirmRequest(Array $expected)
    {
        $this->assertEquals( $expected['method'], $this->getRequestMethod());
        $this->assertEquals(self::SERVICE_URL . $expected['uri'] . "?timestamp=" . self::TIMESTAMP, $this->getRequestUri());
        $this->assertEquals(self::KEY, $this->getRequestAuthentication());
        $this->assertEquals(self::CONTENT_TYPE, $this->getRequestContentType());
        $this->assertEquals($expected['signature'], $this->getRequestSignature());
    }

}