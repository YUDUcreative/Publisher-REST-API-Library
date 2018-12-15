<?php

namespace Bibby\Publisher;

use Bibby\Publisher\Exceptions\PublisherException;
use GuzzleHttp\Client;

/**
 * Class Request
 *
 * Handles requests to the YUDU Publisher REST API
 * @package Bibby\Publisher
 */
class Request {

    /**
     * YUDU Publisher REST API Service Url
     *
     * @var string
     */
    const SERVICE_URL = 'https://api.yudu.com/Yudu/services/2.0/';

    /**
     * YUDU Publisher REST API Key
     *
     * @var string
     */
    private $key;

    /**
     * YUDU Publisher REST API Secret
     *
     * @var string
     */
    private $secret;

    /**
     * HTTP Method
     *
     * @var string
     */
    private $method;

    /**
     * YUDU Publisher Resource URI
     *
     * @var string
     */
    private $resource;

    /**
     * Request Query Parameters
     *
     * @var array
     */
    private $query = [];

    /**
     * Request XML data
     *
     * @var string
     */
    private $data;

    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Debug
     *
     * Guzzle debug mode
     *
     * @var bool
     */
    private $debug = false;

    /**
     * Verify
     *
     * SSL verification
     *
     * @var bool
     */
    private $verify = true;

    /**
     * Request constructor.
     *
     * @param $key
     * @param $secret
     * @param $otions
     * @param $client
     * @throws \Exception
     */
    public function __construct($key, $secret, $options = [], \GuzzleHttp\Client $client = null)
    {
        // Set Credentials
        $this->key = $key;
        $this->secret = $secret;

        // Set debug
        $this->debug = $options['debug'] ?? false;

        // Set ssl verification
        $this->verify = $options['verify'] ?? true;

        // Create client
        $this->client = $client ? $client : new Client();
    }

    /**
     * Method
     *
     * Sets the http request method
     *
     * @param $method
     * @return $this
     * @throws \Exception
     */
    public function method($method)
    {
        if (! in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])){
            throw new PublisherException('Invalid method type given - must be GET, POST, PUT, DELETE');
        }

        $this->method = $method;
        return $this;
    }

    /**
     * Resource
     *
     * Sets the resource URI
     *
     * @param string $resource
     * @return $this
     */
    public function resource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * Query
     *
     * Sets the Query parameters for the request
     *
     * @param array $query
     * @return $this
     */
    public function query($query = [])
    {
        foreach($query as $key => $value)
        {
            $this->query[$key] = $value;
        }
        return $this;
    }

    /**
     * Data
     *
     * Sets the XML data for the request
     *
     * @param string $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Create Request URL
     *
     * @return string
     */
    private function createRequestUrl()
    {
        return self::SERVICE_URL . $this->resource . '?' .  http_build_query($this->query);
    }

    /**
     * Create Signature
     *
     * Creates a base-64 encoded HMAC-SHA256 hash signature
     *
     * @return string
     */
    private function createSignature()
    {
        return base64_encode(hash_hmac('sha256', $this->stringToSign(), $this->secret, true));
    }

    /**
     * String To Sign
     *
     * Builds the URL string to be signed
     *
     * @return string
     */
    private function stringToSign()
    {
        return $this->method . '/Yudu/services/2.0/' . $this->resource . '?' .  $this->createQueryString() . $this->data;
    }

    /**
     * Create Query String
     *
     * Prepares the query string to the format
     * as expected by the API.
     *
     * @return string
     */
    private function createQueryString()
    {
        // Sort query alphabetically
        ksort($this->query);

        // Build query string from query
        $queryString = http_build_query($this->query);

        // Only returns urldecoded query string
        return urldecode($queryString);
    }

    /**
     * Reset
     *
     * Resets class variables back to starting values to
     * prevent contaminating subsequent requests.
     */
    private function reset()
    {
        $this->method = null;
        $this->resource = null;
        $this->query = [];
        $this->data = '';
    }

    /**
     * Make
     *
     * Makes a guzzle request to the YUDU Publisher API
     *
     * @return $this
     * @throws \Bibby\Publisher\Exceptions\PublisherException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function make()
    {
        try {
            // Current timestamp set
            $this->query['timestamp'] = time();

            // Request made to YUDU Publisher
            $this->response = $this->client->request($this->method, $this->createRequestUrl(), [
                'debug'   => $this->debug,
                'verify'  => $this->verify,
                'headers' => [
                    'Authentication' => $this->key,
                    'Content-Type'   => 'application/vnd.yudu+xml',
                    'Signature'      => $this->createSignature(),
                ],
                'http_errors' => false,
                'body'        => $this->data
            ]);
        }
        catch(\Exception $e) {
            throw new PublisherException($e);
        } finally {
            // Always reset the class properties
            $this->reset();
        }

        return $this;
    }

    /**
     * Format
     * // TODO this method
     * Converts guzzle response into client expected response type
     *
     * @returns string/json/XML/Array/Guzzle
     */
    protected function format()
    {

        // Return guzzle object


        //print_r($this->response->getStatusCode()); die();
        //
        //if($this->format === 'GUZZLE')


        $xml = simplexml_load_string($this->response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA, 'http://schema.yudu.com');
        //
        return $xml;

        // Outputs required...

        // raw guzzle , xml object , xml string

        // may need to do some status checking here to decode what to retiurn
    }


}


