<?php

namespace Bibby\Publisher\Tests\Publisher;

use Bibby\Publisher\Tests\PublisherTestCase;

class coreMethodsTest extends PublisherTestCase
{
    private $publisher;

    public function setUp(){
        $this->publisher = $this->buildPublisherClient();
    }

    /**
     * @test
     */
    public function getLinks()
    {
        $this->publisher->getLinks();

        $expected = [
            'method'    => 'GET',
            'uri'       => '',
            'signature' => '2M9n4MDsZrPgC6fQLicOui1uh2+s9KEJ+UdhP2m782A=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getReaders()
    {
        $this->publisher->getReaders();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readers',
            'signature' => 'kRvwEd8CsJUjPWCwAPInZAT4MJCC60edG+RE4G6RsH0=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getReader()
    {
        $this->publisher->getReader(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readers/12345',
            'signature' => 'Sn1RDyoLl62ASRYN9v3vYWMv3HQCzDu+mA5oHzAjYxE=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function createReader()
    {
        $this->publisher->createReader([
            'emailAddress'          => 'user@example.com',
            'username'              => 'example',
            'firstName'             => 'example',
            'lastName'              => 'user',
            'nodeId'                => '12345',
            'password'              => 'secret',
            'authorisedDeviceLimit' => '3',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'readers',
            'signature' => 'lYeAFXCt/ZT83YZja1vFm6FhDwquz1nBp5bMyLo5oag=',
            'body'      => $this->loadXML('createReader')
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function updateReader()
    {
        $this->publisher->updateReader(1, [
            'emailAddress'          => 'user@example.com',
            'username'              => 'example',
            'firstName'             => 'example',
            'lastName'              => 'user',
            'nodeId'                => '12345',
            'password'              => 'secret',
            'authorisedDeviceLimit' => '3',
        ]);

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'readers/1',
            'signature' => 'u47FPdtbDPprcVqUbjj3gz4P5rNV9jB7ssv1IsC/jqo=',
            'body'      => $this->loadXML('updateReader')
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function deleteReader()
    {
        $this->publisher->deleteReader(1);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'readers/1',
            'signature' => 'x1WjCyYSge49467gSnmk+CWErm9rlxqZvEL/Ajix38c=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getEditions()
    {
        $this->publisher->getEditions();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'editions',
            'signature' => '14ZG7lAWtF4Iu4/Z05NWSgOa4QHUYuK6lXiWXQFhY9s=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getEdition()
    {
        $this->publisher->getEdition(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'editions/12345',
            'signature' => 'czuditXGyeKPy5UzMxbgZoBtfIZE5f60tLAi5tzmor8=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getPermissions()
    {
        $this->publisher->getPermissions();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'permissions',
            'signature' => 'KvVslm9cRgbg5PUtQLhWIYPsL2yjriropTOJeHAN7tY=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getPermission()
    {
        $this->publisher->getPermission(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'permissions/12345',
            'signature' => 'otycvX+A6in4WG7PHLyOkGvt7YWs1frjQlKC3x/MMsI=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function createPermission()
    {
        $this->publisher->createPermission([
            'reader'  => '12345',
            'edition' => '64256',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'permissions',
            'signature' => 'nE7x3V1CZiVNdZLG2lmi3Ey2pQ/4hkGlC48opFFdyuc=',
            'body'      => $this->loadXML('createPermission')
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function updatePermission()
    {
        $this->publisher->updatePermission(1, [
            'expiryDate'  => '2015-06-01T00:00:00Z',
        ]);

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'permissions/1',
            'signature' => '1+w+LWvnjvI8TCRNV7VSqIcuFEldxShbMys87TmSV1k=',
            'body'      => $this->loadXML('updatePermission')
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function deletePermission()
    {
        $this->publisher->deletePermission(1);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'permissions/1',
            'signature' => 'qWZxzcTp3WUmyQQpapynnF2805nd7fddMRmM2G4NIRE=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getReaderLogins()
    {
        $this->publisher->getReaderLogins();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readerLogins',
            'signature' => 'cJCL/mWynKKdSjVUttGNWERIzjskXZ0VUblfw3C+iHc=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * @test
     */
    public function getReaderLogin()
    {
        $this->publisher->getReaderLogin(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readerLogins/12345',
            'signature' => 'rb/jMW4sulh+VWiSWY2iUTNu4MU1YvlIqbH14xUdWxg=',
        ];

        $this->confirmRequest($expected);
    }




}

