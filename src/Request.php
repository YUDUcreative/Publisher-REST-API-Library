<?php

namespace Bibby\Publisher;

use GuzzleHttp\Client;

/**
 * Class Request
 *
 * Handles the making of requests to the YUDU Publisher REST API
 * @package Bibby\Publisher
 */
abstract class Request {

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
     * Response output format
     *
     * @var string
     */
    private $output;

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
     * Publisher constructor
     *
     * Initilizes Publisher object and creates guzzle client
     *
     * @param $key
     * @param $secret
     * @param $debug
     * @param $verify
     */
    protected function __construct($key, $secret, $debug = false, $verify = true)
    {
        // Set Credentials
        $this->key = $key;
        $this->secret = $secret;

        // Set debug & ssl verification
        $this->debug = $debug   ? true : false;
        $this->verify = $verify ? true : false;

        // Create guzzle client
        $this->client = new Client();
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
    protected function method($method)
    {
        if (! in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'])){
            throw new \Exception('Invalid method type given - must be GET, POST, PUT, DELETE or OPTIONS');
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
    protected function resource($resource)
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
    protected function query($query = [])
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
    protected function data($data)
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
        return 'https://api.yudu.com/Yudu/services/2.0/' . $this->resource . '?' .  http_build_query($this->query);
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
     * @returns $this
     * @throws // TODO need to add custom exception
     */
    protected function make()
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
        } catch(\Exception $e) {
            throw $e;
        } finally{

            // set debug array or not???

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

        $xml = simplexml_load_string($this->response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA, 'http://schema.yudu.com');

        return $xml;

        // Outputs required...

        // raw guzzle , xml object , xml string

        // may need to do some status checking here to decode what to retiurn
    }


}


