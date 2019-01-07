<?php

namespace Yudu\Publisher\Tests\Publisher;

use Yudu\Publisher\Tests\PublisherTestCase;
use Yudu\Publisher\ResponseHandler;

class ResponseHandlerTest extends PublisherTestCase
{
    public function testResponseHandlerReturnStatusCodes()
    {
        $codes = [ 200, 201, 204, 400, 401, 403, 422, 429, 500 ];

        foreach($codes as $code)
        {
            // Mock a client request
            $client = $this->mockGuzzleClient($code);

            // Make dummy request
            $response = $client->request('GET', '/getReaders');

            // Make response handler to test
            $responseHandler = new ResponseHandler($response);

            // Confirm codes
            $this->assertSame($responseHandler->statusCode(), $code);
        }
    }

    public function testGuzzleResponse()
    {
        // Mock a client request
        $client = $this->mockGuzzleClient();

        // Make dummy request
        $response = $client->request('GET', '/getReaders');

        // Make response handler to test
        $responseHandler = new ResponseHandler($response);

        // Confirm guzzle method returns guzzle response
        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $responseHandler->guzzle());
    }

    public function testXmlResponses()
    {
        // Get an example response as xml from file
        $xml = simplexml_load_file(__DIR__ . '/xml/exampleResponse.xml', 'SimpleXMLElement', LIBXML_NOBLANKS);

        // Mock a client request
        $client = $this->mockGuzzleClient(200, [], $xml->asXML());

        // Make dummy request
        $response = $client->request('POST', '/getReaders');

        // Make response handler to test
        $responseHandler = new ResponseHandler($response);

        // Confirm Xml method returns Simple xml object
        $this->assertInstanceOf('SimpleXMLElement', $responseHandler->xml());

        // Confirm asXml method returns expected xml string
        $this->assertEquals($xml->asXML(), $responseHandler->xmlString());
    }
}

