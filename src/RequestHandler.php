<?php

namespace Yudu\Publisher;

use GuzzleHttp\Client;

class RequestHandler {

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
     * Request options
     *
     * @var array
     */
    private $options = [];

    /**
     * HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

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
     * Request constructor.
     *
     * @param $key
     * @param $secret
     * @param $options
     * @param $client
     * @throws \Exception
     */
    public function __construct($key, $secret, Array $options = [], \GuzzleHttp\Client $client = null)
    {
        // Set Credentials
        $this->key = $key;
        $this->secret = $secret;

        // Set options
        $this->options = $options;

        // Set HTTP Client
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
    protected function method($method)
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
    protected function resource($resource)
    {
        $this->resource = ltrim($resource, '/');
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
        return self::SERVICE_URL . $this->resource . '?' .  http_build_query($this->query);
    }

    /**
     * Create Signature
     *
     * Creates a base-64 encoded HMAC-SHA256 hash signature
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
     * Makes an HTTP request to the YUDU Publisher API
     *
     * @return $this
     * @throws \Bibby\Publisher\Exceptions\PublisherException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function make()
    {
        try {
            // Unless overriden ensure current timestamp is set
            $this->query['timestamp'] = $this->options['timestamp'] ?? time();

            // Request made to YUDU Publisher
            $response = $this->client->request($this->method, $this->createRequestUrl(), [
                'debug'   => $this->options['debug'] ?? false,
                'verify'  => $this->options['verify'] ?? true,
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
            $this->reset();
        }

        return new ResponseHandler($response);
    }
}


