<?php

namespace Yudu\Publisher;

use Psr\Http\Message\ResponseInterface;
use SimpleXMLElement;

/**
 * Response Handler
 *
 * @package   yudu/publisher
 * @author    Andrew James Bibby
 * @license   MIT License
 * @link      https://github.com/YUDUcreative/Publisher-REST-API-Library
 *
 * This class wraps the Guzzle Response Interface and provides a few
 * convenient methods to transform the response.
 */
class ResponseHandler {

    /**
     * Response Object
     *
     * @var ResponseInterface
     */
    private $response;

    /**
     * Request
     *
     * @var array
     */
    private $request;

    /**
     * ResponseHandler constructor.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @param  array  $request
     */
    public function __construct(ResponseInterface $response, array $request = [])
    {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * Request Data
     *
     * @return array
     */
    public function request(): array
    {
        return $this->request;
    }

    /**
     * Response Data
     *
     * @return ResponseInterface
     *
     */
    public function response(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Raw
     *
     * @return string
     */
    public function raw(): ?string
    {
        return $this->request->raw ?? null;
    }

    /**
     * Status Code
     *
     * @return int
     */
    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Guzzle
     *
     * @return ResponseInterface
     */
    public function guzzle(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * Xml
     *
     * @return \SimpleXMLElement|bool
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
    public function xmlString(): ?string
    {
        return $this->xml() ? $this->xml()->asXML() : null;
    }

    /**
     * To String
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->response->getBody()->getContents();
    }
}


