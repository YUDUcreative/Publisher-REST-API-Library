<?php

namespace Bibby\Publisher;

use GuzzleHttp\Client;

/**
 * YUDU REST API Wrapper Library
 *
 * @package   bibby/publisher
 * @author    Andrew Bibby <support@yudu.com>
 * @license   MIT
 * @link      https://github.com/YUDUcreative/Publisher-REST-API-Library
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
    private $output;

    /**
     * Last Request Debug Info
     *
     * @var array
     */
    private $debugInfo = [];

    /**
     * Debug
     *
     *  Guzzle debug mode
     *
     * @var bool
     */
    private $debug = false;

    /**
     * Publisher constructor
     *
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
     *
     * Sets the GET request method
     *
     * @return $this
     */
    private function get()
    {
        $this->method = 'GET';
        return $this;
    }

    /**
     * Post
     *
     * Sets the request method to 'POST'
     *
     * @return $this
     */
    private function post()
    {
        $this->method = 'POST';
        return $this;
    }

    /**
     * Put
     *
     * Sets the request method to 'PUT'
     *
     * @return $this
     */
    private function put()
    {
        $this->method = 'PUT';
        return $this;
    }

    /**
     * Delete
     *
     * Sets the request method to 'DELETE'
     *
     * @return $this
     */
    private function delete()
    {
        $this->method = 'DELETE';
        return $this;
    }

    /**
     * Options
     *
     * Sets the request method to 'OPTIONS'
     *
     * @return $this
     */
    private function options()
    {
        $this->method = 'OPTIONS';
        return $this;
    }

    /**
     * Resource
     *
     * Sets the Query parameters for the request
     *
     * @param array $query
     * @return $this
     */
    private function resource($resource)
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
    private function query($query = [])
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
     * Debug Info
     *
     * Returns an array of all object variables which were
     * used in the last API call.
     *
     * @return array
     */
    public function debugInfo()
    {
        return $this->debugInfo;
    }

    public function debug($debug = false)
    {
        $this->debug = $debug ? true : false;
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
        $this->data = [];
    }

    /**
     * Set Debug Info
     *
     * Fills debug info with current class variable values
     */
    private function setDebugInfo()
    {
        $this->debugInfo = [
            'method'   => $this->method,
            'resource' => $this->resource,
            'query'    => $this->query,
            'data'     => $this->data,
            'output'   => $this->output,
        ];
    }

    /**
     * Make
     *
     * Makes a guzzle request to the Publisher API
     * Returns a formatted response
     *
     * @returns Guzzle Obj
     * @throws PublisherRequestException
     */
    public function make()
    {
        try {
            // Current timestamp set
            $this->query['timestamp'] = time();

            // Request made to REST API
            $response = $this->client->request($this->method, $this->createRequestUrl(), [
                'debug'   => $this->debug,
                'headers' => [
                    'Authentication' => $this->key,
                    'Content-Type'   => 'application/vnd.yudu+xml',
                    'Signature'      => $this->createSignature(),
                ],
                'http_errors' => false,
                'body'        => $this->data
            ]);

            $this->response = $response;
            $this->setDebugInfo();
            $this->reset();

        } catch(\Exception $e) {
            $this->setDebugInfo();
            $this->reset();
            throw $e;
        }

        return $this;
    }

    /**
     * Format
     *
     * Converts guzzle response into client expected response type
     *
     * @returns string/json/XML/Array/Guzzle
     */
    public function format()
    {
        // When in debug mode only raw request/response returned
        if($this->debug){
            return (string) $this->response->getBody();
        }

        // Build XML object from XML response
        $xml = simplexml_load_string($this->response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA, 'http://schema.yudu.com');

        if($this->output === 'XML'){
            return $xml->asXML();
        }

        if($this->output === 'JSON'){
            return json_encode($xml);
        }

        if($this->output === 'ARRAY'){
            return json_decode(json_encode($xml), true);
        }

        return $response;
    }

    /**
     * Set Output
     *
     * Sets the class output format type
     *
     * @param $output
     */
    public function setOutput($output)
    {
        if(! in_array($output, ['JSON', 'ARRAY', 'XML'])){
            throw new \Exception('Cannot set invalid output type - must be one of JSON / ARRAY / XML');
        }

        $this->output = $output;
    }

    /**
     * CONVENIENT API REQUEST METHODS
     *
     * The following methods are convenient and simple methods
     * which can be used to make calls without building the
     * requests manually. All methods mirror available API
     * endpoints as detailed in the YUDU Publisher API
     * documentation at:
     *
     * https://github.com/yudugit/rest-api-documentation#uri-summary
     */

    /**
     * Get Links
     *
     * Returns a list of links to the other available URIs
     */
    public function getLinks()
    {
        return $this->get()->resource('')->make();
    }

    /**
     * Get Readers
     *
     * Returns a list of readers
     *
     * @param null $id
     * @param array $query
     */
    public function getReaders($id = null, $query = [])
    {
        $resource = $id ? "readers/$id" : "readers";

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    /**
     * Creates a new Publisher Reader
     *
     * @param $data
     */
    public function createReader($data)
    {
        $xml = XMLBuilder::reader($data);

        return $this->post()->resource('readers')->data($xml)->make()->format();
    }

    /**
     * Updates a Publisher Reader
     *
     * @param $id
     * @param $data
     */
    public function updateReader($id, $data)
    {
        $xml = XMLBuilder::reader($data, $id);

        return $this->put()->resource('readers/' . $id)->data($xml)->make()->format();
    }

    /**
     * Deletes a Publisher Reader
     *
     * @param $id
     */
    public function deleteReader($id)
    {
        return $this->delete()->resource('readers/' . $id)->make()->format();
    }

    /**
     * Get Editions
     *
     * Returns a list of editions
     *
     * @param null $id
     * @param array $query
     */
    public function getEditions($id = null, $query = [])
    {
        $resource = $id ? "editions/$id" : "editions";

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    /**
     * Get Permissions
     *
     * Lists edition permissions by reader
     *
     * @param null $id
     * @param array $query
     */
    public function getPermissions($id = null, $query = [])
    {
        $resource = $id ? "permissions/$id" : "permissions";

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    /**
     * Creates a new permission for a reader
     *
     * @param $data
     */
    public function createPermission($data)
    {
        $xml = XMLBuilder::permission($data);

        return $this->post()->resource('permissions')->data($xml)->make()->format();
    }

    /**
     * TODO Updates a reader permission broken!
     *
     * @param $id
     * @param $data
     */
    public function updatePermission($id, $data)
    {
        $xml = XMLBuilder::reader($data);

        return $this->put()->resource('permissions/' . $id)->data($xml)->make()->format();
    }

    /**
     * Creates a new permission for a reader
     *
     * @param $data
     */
    public function deletePermission($id)
    {
        return $this->delete()->resource('permissions/' . $id)->make()->format();
    }

    /**
     * Get Reader Logins
     *
     * @param null $id
     * @param array $query
     */
    public function getReaderLogins($id = null, $query = [])
    {
        $resource = $id ? "readerLogins/$id" : "readerLogins";

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    /**
     * Get Publications
     *
     * @param null $id
     * @param array $query
     */
    public function getPublications($id = null, $query = [])
    {
        $resource = $id ? "publications/$id" : "publications";

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    /**
     * TODO this returns 500.. why?
     * Get Subscriptions
     *
     * @param null $id
     * @param array $query
     */
    public function getSubscriptions($id = null, $query = [])
    {
        $resource = $id ? "subscriptions/$id" : "subscriptions";

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    // TODO subscriptionPeriods methods (can do withoutgetSubscriptions working..)

    /**
     * Remove Devices
     *
     * Removes all authorised devices for a user
     *
     * @param $id
     */
    public function removeDevices($id)
    {
        return $this->delete()->resource('readers/' . $id . '/authorisedDevices')->make()->format();
    }

}


