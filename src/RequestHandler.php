<?php

namespace Yudu\Publisher;

use Yudu\Publisher\Exceptions\PublisherException;
use InvalidArgumentException;
use GuzzleHttp\Client;
use Exception;

class RequestHandler {

    /**
     * YUDU Publisher REST API Service Url
     *
     * @var string
     */
    const SERVICE_URL = 'https://api.yudu.com/Yudu/services/';

    /**
     * API Version
     *
     * @var string
     */
    private $version;

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
     * RequestHandler constructor.
     *
     * @param $key
     * @param $secret
     * @param  array  $options
     * @param  string  $version
     * @param  \GuzzleHttp\Client|null  $client
     */
    protected function __construct(string $key, string $secret, Array $options = [], string $version = '2.1', Client $client = null)
    {
        // Set credentials and options
        $this->setCredentials($key, $secret);
        $this->setOptions($options);
        $this->setApiVersion($version);

        // Set HTTP Client
        $this->client = $client ? $client : new Client();
    }

    /**
     * Set Credentials
     *
     * @param string $key
     * @param string $secret
     */
    private function setCredentials($key = null, $secret = null)
    {
        if(!$key || !$secret){
            throw new InvalidArgumentException('Publisher Key AND Publisher Secret must be specified.');
        }
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * Set options
     *
     * Validates and sets the request options
     *
     * @param $options
     */
    public function setOptions($options)
    {
        foreach($options as $key => $value){
            if(!in_array($key, [ "timestamp", "verify", "debug" ])){
                throw new InvalidArgumentException("$key is not a valid option parameter.");
            }
        }
        $this->options = $options;
    }

    /**
     * Set API Version
     *
     * Validates and sets the API version
     *
     * @param  string  $version
     */
    private function setApiVersion(string $version)
    {
        if(!in_array($version, [ "2.0", "2.1",])){
            throw new InvalidArgumentException("$version is not a valid api version.");
        }

        $this->version = $version;
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
    public function method($method): self
    {
        if (! in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])){
            throw new InvalidArgumentException('Invalid method type given - must be GET, POST, PUT, DELETE');
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
    public function resource(string $resource): self
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
    public function query(array $query = []): self
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
    public function data(string $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Create Request URL
     *
     * @return string
     */
    private function createRequestUrl(): string
    {
        return self::SERVICE_URL . $this->version . '/' . $this->resource . '?' .  http_build_query($this->query);
    }

    /**
     * Create Signature
     *
     * Creates a base-64 encoded HMAC-SHA256 hash signature
     *
     * @return string
     */
    private function createSignature(): string
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
    private function stringToSign(): string
    {
        return $this->method . '/Yudu/services/' . $this->version . '/' . $this->resource . '?' .  $this->createQueryString() . $this->data;
    }

    /**
     * Create Query String
     *
     * Prepares the query string to the format
     * as expected by the API.
     *
     * @return string
     */
    private function createQueryString(): string
    {
        // Sort query alphabetically
        ksort($this->query);

        // Build query string from query
        $queryString = http_build_query($this->query);

        // Only returns url decoded query string
        return urldecode($queryString);
    }

    /**
     * Reset
     *
     * Resets class variables back to starting values to prevent
     * contaminating subsequent requests.
     *
     * @return void
     */
    private function reset(): void
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
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function make(): ResponseHandler
    {
        try {
            // Unless overridden ensure current timestamp is set
            $this->query['timestamp'] = $this->options['timestamp'] ?? time();

            // Begin output buffering
            ob_start();

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

            // Obtain raw request/response headers from output buffer
            $raw = ob_get_clean();

            // Grab raw request data
            $request = [
                'method'    => $this->method,
                'resource'  => $this->resource,
                'query'     => $this->query,
                'data'      => $this->data,
                'raw'       => $raw,
            ];

            return new ResponseHandler($response, $request);
        }
        catch(Exception $e) {
            throw new PublisherException($e);
        } finally {
            $this->reset();
        }
    }
}


