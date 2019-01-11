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
     * ResponseHandler constructor
     *
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
       $this->response = $response;
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


