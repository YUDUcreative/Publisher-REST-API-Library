<?php

namespace Squibby\Publisher;

use GuzzleHttp\Client;
use XMLBuilder;

/**
 * YUDU REST API Wrapper Library
 *
 * @package   squibby/publisher
 * @author    Andrew Bibby <support@yudu.com>
 * @license TODO
 * @link TODO
 */

class Publisher {

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
    private $output = 'JSON';

    /**
     * Last Request Debug Info
     *
     * @var array
     */
    private $debug = [];

    /**
     * Publisher constructor
     * Initilizes Publisher object and creates guzzle client
     *
     * @param $key
     * @param $secret
     */
    public function __construct($key, $secret)
    {
        // Set Credentials
        $this->key = $key;
        $this->secret = $secret;

        // Create guzzle client
        $this->client = new Client();
    }

    /**
     * Get
     * Sets the GET request method
     *
     * @return $this
     */
    public function get()
    {
        $this->method = 'GET';
        return $this;
    }

    /**
     * Post
     * Sets the request method to 'POST'
     *
     * @return $this
     */
    public function post()
    {
        $this->method = 'POST';
        return $this;
    }

    /**
     * Put
     * Sets the request method to 'PUT'
     *
     * @return $this
     */
    public function put()
    {
        $this->method = 'PUT';
        return $this;
    }

    /**
     * Delete
     * Sets the request method to 'DELETE'
     *
     * @return $this
     */
    public function delete()
    {
        $this->method = 'DELETE';
        return $this;
    }

    /**
     * Options
     * Sets the request method to 'OPTIONS'
     *
     * @return $this
     */
    public function options()
    {
        $this->method = 'OPTIONS';
        return $this;
    }

    /**
     * Resource
     * Sets the Query parameters for the request
     *
     * @param array $query
     * @return $this
     */
    public function resource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * Query
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
     * Sets the XML data for the request
     *
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Create Request URL
     * @return string
     */
    private function createRequestUrl()
    {
        return 'https://api.yudu.com/Yudu/services/2.0/' . $this->resource . '?' .  http_build_query($this->query);
    }

    /**
     * Create Signature
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
     * Prepares the query string to the format
     * as expected by the API.
     *
     * @return string
     */
    public function createQueryString()
    {
        // Sort query alphabetically
        ksort($this->query);

        // Build query string from query
        $queryString = http_build_query($this->query);

        // Only returns urldecoded query string
        return urldecode($queryString);
    }

    /**
     * ToJson
     * Sets output 'JSON' and triggers request
     */
    public function toJson()
    {
        $this->output = 'JSON';
        return $this->make();
    }

    /**
     * ToXML
     * Sets output 'XML' and triggers request
     */
    public function toXML()
    {
        $this->output = 'XML';
        return $this->make();
    }

    /**
     * ToArray
     * Sets output 'JSON' and triggers request
     */
    public function toArray()
    {
        $this->output = 'ARRAY';
        return $this->make();
    }

    /**
     * Debug
     * Returns an array of all object variables which were
     * used in the last API call. This is useful for
     * inspecting parameters used when debugging.
     *
     * @return array
     */
    public function debug()
    {
        return $this->debug;
    }

    /**
     * Reset
     * Stores all current vars to last query variable for debugging,
     * resets the class variables back to starting values which
     * prevents contaminating subsequent requests.
     */
    private function reset()
    {
        // Fills debug with current class variable values
        $this->debug = [
            'method'   => $this->method,
            'resource' => $this->resource,
            'query'    => $this->query,
            'data'     => $this->data,
            'output'   => $this->output,
        ];

        // Resets class variables back to original values
        $this->method = null;
        $this->resource = null;
        $this->query = [];
        $this->data = [];
    }

    /**
     * Make
     * Makes a guzzle request to the Publisher API
     * Returns a formatted response
     *
     * @returns json/XML/Array/Raw
     * @throws PublisherRequestException
     */
    public function make()
    {
        try {
            // Current timestamp set
            $this->query['timestamp'] = time();

            // Request made to REST API
            $response = $this->client->request($this->method, $this->createRequestUrl(), [
                'headers' => [
                    'Authentication' => $this->key,
                    'Content-Type'   => 'application/vnd.yudu+xml',
                    'Signature'      => $this->createSignature(),
                ],
                'http_errors' => false,
                'body'        => $this->data
            ]);

            // Response formatted to output format
            $formattedResponse = $this->formatResponse($response, $this->output);

            // Class variables reset (to ensure future requests not contaminated)
            $this->reset();

            return $formattedResponse;

        } catch (\Exception $e) {
            throw $e;
            // Here i will throw a custom squibby/publisher exception.
            // Also need to reset all vars here
        }
    }

    /**
     * Format Response
     * Converts guzzle response into client expected response type
     *
     * @param $response - Guzzle response object
     * @param $output - Output format
     * @returns json/XML/Array/Raw
     */
    private function formatResponse($response, $output)
    {
        $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);

        if($output === 'XML'){
            return $xml;
        }

        if($output === 'JSON'){
            return json_encode($xml);
        }

        if($output === 'ARRAY'){
            return json_decode(json_encode($xml), true);
        }

        return $response->getBody();
    }

    /**
     * Set Output
     * Sets the class output type
     *
     * @param $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * Convenient methods
     * (without directly building the request manually)
     * All methods mirror available actions as specified in
     * REST API docs
     */

    /**
     * CONVENIENT API REQUEST METHODS
     * The following methods are convenient and simple methods
     * which can be used to make calls without building the
     * requests manually. All methods mirror available API
     * endpoints as detailed in the YUDU Publisher API
     * documentation at:
     * https://github.com/yudugit/rest-api-documentation#uri-summary
     */

    /**
     * Get Links
     * Returns a list of links to the other available URIs
     */
    public function getLinks()
    {
        return $this->get()->resource('')->make();
    }

    /**
     * Get Readers
     * Returns a list of readers / single reader by ID
     *
     * @param null $id
     * @param array $query
     */
    public function getReaders($id = null, $query = [])
    {
        $resource = $id ? "readers/$id" : "readers";

        return $this->get()->resource($resource)->query($query)->make();
    }

    /**
     * Creates a new Publisher Reader
     *
     * @param $data
     */
    public function createReader($data)
    {
        $dom = new \DomDocument();

        $reader = $dom->createElementNS('http://schema.yudu.com', "reader");
        $dom->appendChild($reader);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->appendChild($dom->createTextNode($value));
            $reader->appendChild($element);
        }

        $xml = $dom->saveXML();

        return $this->post()->resource('readers')->data($xml)->make();
    }

    /**
     * Updates a Publisher Reader
     *
     * @param $id
     * @param $data
     */
    public function updateReader($id, $data)
    {
        $dom = new \DomDocument();

        $reader = $dom->createElementNS('http://schema.yudu.com', "reader");

        $reader->setAttribute("id", $id);

        $dom->appendChild($reader);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->appendChild($dom->createTextNode($value));
            $reader->appendChild($element);
        }

        $xml = $dom->saveXML();

        return $this->put()->resource('readers/' . $id)->data($xml)->make();
    }

    /**
     * Deletes a Publisher Reader
     *
     * @param $id
     */
    public function deleteReader($id)
    {
        return $this->delete()->resource('readers/' . $id)->make();
    }

    /**
     * Get Editions
     * Returns a list of editions / single edition by ID
     *
     * @param null $id
     * @param array $query
     */
    public function getEditions($id = null, $query = [])
    {
        $resource = $id ? "editions/$id" : "editions";

        return $this->get()->resource($resource)->query($query)->make();
    }

    // TODO
    //public function sendNotifications(){
    //
    //}

}


