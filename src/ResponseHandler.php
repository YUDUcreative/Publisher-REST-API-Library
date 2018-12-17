<?php

namespace Bibby\Publisher;

class ResponseHandler {

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
        return $this->xml()->asXML();
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


