<?php

namespace Yudu\Publisher;

/**
 * Response Handler
 *
 * @package   yudu/publisher
 * @author    Andrew James Bibby
 * @license   MIT License
 * @link      https://github.com/YUDUcreative/Publisher-REST-API-Library
 *
 * This class wraps the Guzzle Response Object and provides a few
 * convenient methods to transform the response.
 */
class ResponseHandler {

    /**
     * Response Object
     *
     * \GuzzleHttp\Psr7\Response
     */
    private $response;

    /**
     * Request
     *
     * @var array
     */
    private $request;

    /**
     * ResponseHandler constructor
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @param null|string $raw
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response, array $request = [])
    {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * Request Data
     *
     * @return array
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * Raw
     *
     * @return string
     */
    public function raw()
    {
        return $this->request->raw ?? null;
    }

    /**
     * Status Code
     *
     * @return int
     */
    public function statusCode()
    {
        return $this->response->getStatusCode();
    }

    /**
     * Guzzle
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function guzzle()
    {
        return $this->response;
    }

    /**
     * Xml
     *
     * @return \SimpleXMLElement
     */
    public function xml()
    {
        return simplexml_load_string($this->response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA, 'http://schema.yudu.com');
    }

    /**
     * Xml String
     *
     * @return string
     */
    public function xmlString()
    {
        return $this->xml() ? $this->xml()->asXML() : null;
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString()
    {
        return $this->response->getBody()->getContents();
    }
}


