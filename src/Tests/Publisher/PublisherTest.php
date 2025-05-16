<?php

namespace Yudu\Publisher\Tests\Publisher;

use Yudu\Publisher\Tests\PublisherTestCase;

class PublisherTest extends PublisherTestCase
{
    private $publisher;

    public function setUp(): void
    {
        $this->publisher = $this->buildPublisherClient();
    }

    /**
     * Get Links
     */
    public function testGetLinks()
    {
        $this->publisher->getLinks();

        $expected = [
            'method'    => 'GET',
            'uri'       => '',
            'signature' => 'JHpf0clSlU4Heg//Lo4TxlXyyWxAYMmaMSIgr3oE84A=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Readers
     */
    public function testGetReaders()
    {
        $this->publisher->getReaders();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readers',
            'signature' => 'E9RAVo/ZpgqeId+XJ5NiXW3j3CSxM8F6jdQvMM3RsvY=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Reader
     */
    public function testGetReader()
    {
        $this->publisher->getReader(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readers/12345',
            'signature' => 'WIMdjcVsHzD2WkZ9MPEMcQInDoU9yWWmpPu7XBlxppU=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Reader
     */
    public function testCreateReader()
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
            'signature' => '98VRZgeRqwx/g8YeK++QfPBWlY9HCB+nc1AEyIscoBM=',
            'body'      => $this->loadXML('createReader'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Update Reader
     */
    public function testUpdateReader()
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
            'signature' => 'KcABo3a6BaGPYTcNpnPcyrQ7gmKMUSIb10J8a8/Wo5E=',
            'body'      => $this->loadXML('updateReader'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Delete Reader
     */
    public function testDeleteReader()
    {
        $this->publisher->deleteReader(1);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'readers/1',
            'signature' => 'ODYi5mImQDGD61cjN/lKiyiomZRx5Wo8Te8eN+7LrfA=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Editions
     */
    public function testGetEditions()
    {
        $this->publisher->getEditions();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'editions',
            'signature' => 't8xILJtCtW4RGy+hNp6Pjy1jbWrshhWN28zuExUQu8w=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Edition
     */
    public function testGetEdition()
    {
        $this->publisher->getEdition(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'editions/12345',
            'signature' => '6QtFJck8+byTceqhXlvTzvYYD5h7zrBTZ9k8HMJAeck=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Permissions
     */
    public function testGetPermissions()
    {
        $this->publisher->getPermissions();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'permissions',
            'signature' => '4ngfkUuCgAYQtqkpKW6g09W0G2zpxHdNQO3f2jTFd/4=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Permission
     */
    public function testGetPermission()
    {
        $this->publisher->getPermission(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'permissions/12345',
            'signature' => 'yf3o6CBdUcusZTiX71rTcTNzS7EtRRLlnVD2/Oa1hCg=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Permission
     */
    public function testCreatePermission()
    {
        $this->publisher->createPermission([
            'reader'  => '12345',
            'edition' => '64256',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'permissions',
            'signature' => '3LGXWt0l4OmT5mTLyk5QLADiRmhSIlTW0ljpANnRALE=',
            'body'      => $this->loadXML('createPermission'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Update Permission
     */
    public function testUpdatePermission()
    {
        $this->publisher->updatePermission(1, [
            'expiryDate' => '2015-06-01T00:00:00Z',
        ]);

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'permissions/1',
            'signature' => 'JoNTy8MhAtMclcHxonRiS8x3AAbBuYHbkCQHORF0dAk=',
            'body'      => $this->loadXML('updatePermission'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Delete Permission
     */
    public function testDeletePermission()
    {
        $this->publisher->deletePermission(1);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'permissions/1',
            'signature' => 'Rmo/PTJGNS6JPyBtenatm3vU2+R6bK13EkwTy/Fo6zs=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Reader Logins
     */
    public function testGetReaderLogins()
    {
        $this->publisher->getReaderLogins();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readerLogins',
            'signature' => 'nKXWVeZQ25ivUWQm7SM+ll8MaIyz+pFgGpYK6SMQLhY=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Reader Login
     */
    public function testGetReaderLogin()
    {
        $this->publisher->getReaderLogin(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readerLogins/12345',
            'signature' => 'G+Ru03oGaAr2kAh4lLgL4Q/BMazQ8OCplX5XtGbB37E=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Publications
     */
    public function testGetPublications()
    {
        $this->publisher->getPublications();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'publications',
            'signature' => 'coP57NXLVPI4DmCIIt6kHv+8uzpcj2hyYpzGT2zIE1Q=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Publication
     */
    public function testGetPublication()
    {
        $this->publisher->getPublication(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'publications/12345',
            'signature' => 'h6nYTPVYkbprvCMObhxNXjMMPTNB/Tcjav9U0MZdjWs=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Subscriptions
     */
    public function testGetSubscriptions()
    {
        $this->publisher->getSubscriptions();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'subscriptions',
            'signature' => 'bDkNUGSrNvBXsXeYF+kTT5lDtaCNnBU9OkwaPJA5K/8=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Subscription
     */
    public function testGetSubscription()
    {
        $this->publisher->getSubscription(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'subscriptions/12345',
            'signature' => 'MHs6UjmLES6uuGrtcTJP9ujDnA0OaBiDl9bj2D2MNIQ=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Subscription Periods
     */
    public function testGetSubscriptionPeriods()
    {
        $this->publisher->getSubscriptionPeriods();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'subscriptionPeriods',
            'signature' => '2HlFO1zdEHEkDf1kpn2sQmbuD0/gcvj/xTuygtq434w=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Subscription Period
     */
    public function testGetSubscriptionPeriod()
    {
        $this->publisher->getSubscriptionPeriod(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'subscriptionPeriods/12345',
            'signature' => 'IlHSTVOIOFBzhq2XuX2SN26w5B3eenwcUPL9hD6FOV8=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Subscription Period
     */
    public function testCreateSubscriptionPeriod()
    {
        $this->publisher->createSubscriptionPeriod([
            'reader'       => '1234',
            'subscription' => '9876',
            'startDate'    => '2014-11-01T00:00:00Z',
            'expiryDate'   => '2016-11-01T00:00:00Z',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'subscriptionPeriods',
            'signature' => 'Fvsqng8GEBKTrE/kveQFmoquLVAxPrGeupe6MP/J9wI=',
            'body'      => $this->loadXML('createSubscriptionPeriod'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Update Subscription Period
     */
    public function testUpdateSubscriptionPeriod()
    {
        $this->publisher->updateSubscriptionPeriod(1, [
            'startDate'  => '2014-11-01T00:00:00Z',
            'expiryDate' => '2016-11-01T00:00:00Z',
        ]);

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'subscriptionPeriods/1',
            'signature' => 'jFJuAuMpPU9xndNSd6SOVzWWwbjP1GGiKuV2/ebuW3A=',
            'body'      => $this->loadXML('updateSubscriptionPeriod'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Delete Subscription Period
     */
    public function testDeleteSubscriptionPeriod()
    {
        $this->publisher->deleteSubscriptionPeriod(1);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'subscriptionPeriods/1',
            'signature' => '9zHLdJMJclAjHZ4XQFCJ8wb1Ef6Mg2i+7kwDd0Km6/4=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Remove Devices
     */
    public function testRemoveDevices()
    {
        $this->publisher->removeDevices(1);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'readers/1/authorisedDevices',
            'signature' => 'dWomJCXo5OzPRMynVY9sUoADmRUn1mE8Yayh15vRenc=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Authenticate Password
     */
    public function testAuthenticatePassword()
    {
        $this->publisher->authenticatePassword(1, '%$Rfdg_)ka,Ki');

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'readers/1/authentication',
            'signature' => 'ha+XHFDtSrkek9hbUu/H7KBSRQ6NaQJVkQOHhoWqJW8=',
            'body'      => $this->loadXML('authenticatePassword'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Token
     */
    public function testCreateToken()
    {
        $this->publisher->createToken('user12345');

        $expected = [
            'method'    => 'POST',
            'uri'       => 'token',
            'signature' => '2qYDsY1UNp51ySIUjpcSgl8OJbJMunIwe/p8UAXCDHY=',
            'body'      => $this->loadXML('createToken'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Publication Token
     */
    public function testCreatePublicationToken()
    {
        $this->publisher->createPublicationToken('user12345', '1');

        $expected = [
            'method'    => 'POST',
            'uri'       => 'publications/1/token',
            'signature' => 'egBFkCmj4hVBfkKg3Zdhbsv2TktjEHH7M15nD+9jXC4=',
            'body'      => $this->loadXML('createToken'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Edition Token
     */
    public function testCreateEditionToken()
    {
        $this->publisher->createEditionToken('user12345', '1');

        $expected = [
            'method'    => 'POST',
            'uri'       => 'editions/1/token',
            'signature' => '5u8Ay/LgbMHKD4ECpEAprDexiG6uvAiFvVmijxQ5j6U=',
            'body'      => $this->loadXML('createToken'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Send Targeted Notification
     */
    public function testSendTargetedNotification()
    {
        $nodeId = '1234';
        $title = 'Targeted Notification';
        $message = 'Hello World!';
        $priority = 'DEFAULT';
        $subscribers = ['billy123', 'unclebob69', 'Mjaxson'];
        $thirdPartySubscribers = ['cnfvwh4p93jcllljfd', 'g5q456uyhb565hta5br', 'vb49ierd39jgvr939kkjd'];
        $disableSound = 'false';

        $this->publisher->sendTargetedNotification($nodeId, $title, $message, $subscribers, $thirdPartySubscribers, $priority, $disableSound);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'targetedNotifications',
            'signature' => 'oyd/HZ/gMh+BMgaBh0snBTLkXYt9mz2jJdy86CD8cfI=',
            'body'      => $this->loadXML('sendTargetedNotification'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Get Categories
     */
    public function testGetCategories()
    {
        $this->publisher->getCategories();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'categories',
            'signature' => '05fMVndSXKDiph2WfpICTCbXQ6Z/SbKO7jBDOwq2sD8=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Category
     */
    public function testCreateCategory()
    {
        $this->publisher->createCategory([
            'categoryTitle'     => 'Category Example',
            'code'              => 'CATEGORY_EXAMPLE',
            'containsAll'       => 'true',
            'defaultCategory'   => 'false',
            'ordering'          => '4',
            'publicationNodeId' => '61',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'categories',
            'signature' => 'd3sxk09nNsGjJ1bO0bIkpRe/Euvj9Kf4IwSScTar+Eg=',
            'body'      => $this->loadXML('createCategory'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Delete Categories
     */
    public function testDeleteCategories()
    {
        $this->publisher->deleteCategories('12345');

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'categories',
            'signature' => 'YYpBhnedj99QHIVgzpZt6KQ+9fV/uya43Xm3gjmRqag=',
            'body'      => '',
        ];

        $this->assertEquals($expected['method'], $this->getRequestMethod());
        $this->assertEquals(self::SERVICE_URL . $expected['uri'] . "?publicationNodeId=12345&timestamp=" . self::TIMESTAMP, $this->getRequestUri());
        $this->assertEquals(self::KEY, $this->getRequestAuthentication());
        $this->assertEquals(self::CONTENT_TYPE, $this->getRequestContentType());
        $this->assertEquals($expected['signature'], $this->getRequestSignature());
    }

    /**
     * Get Category
     */
    public function testGetCategory()
    {
        $this->publisher->getCategory('category_code');

        $expected = [
            'method'    => 'GET',
            'uri'       => 'categories/category_code',
            'signature' => 'AD7zOnZT/XVOXUfdZ07m+eCirpY8WaqRRZNcTH1JRUs=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Update Category
     */
    public function testUpdateCategory()
    {
        $this->publisher->updateCategory('category_code', '12345', [
            'categoryTitle'     => 'Category Example',
            'code'              => 'CATEGORY_EXAMPLE',
            'containsAll'       => 'true',
            'defaultCategory'   => 'false',
            'ordering'          => '4',
            'publicationNodeId' => '61',
        ]);

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'categories/category_code',
            'signature' => 'D/0Ufp8Q597dBJFeZV2CtMZ6aPpWE8V8GLIsHSHojAI=',
            'body'      => $this->loadXML('createCategory'),
        ];

        $this->assertEquals($expected['method'], $this->getRequestMethod());
        $this->assertEquals(self::SERVICE_URL . $expected['uri'] . "?publicationNodeId=12345&timestamp=" . self::TIMESTAMP, $this->getRequestUri());
        $this->assertEquals(self::KEY, $this->getRequestAuthentication());
        $this->assertEquals(self::CONTENT_TYPE, $this->getRequestContentType());
        $this->assertEquals($expected['signature'], $this->getRequestSignature());
    }

    /**
     * Delete Category
     */
    public function testDeleteCategory()
    {
        $this->publisher->deleteCategory('category_code', '12345');

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'categories/category_code',
            'signature' => '5Ng7812Urbs5KV5Kkv+Z1e5kxp06KTC6VrXZJmbhBQo=',
            'body'      => '',
        ];

        $this->assertEquals($expected['method'], $this->getRequestMethod());
        $this->assertEquals(self::SERVICE_URL . $expected['uri'] . "?publicationNodeId=12345&timestamp=" . self::TIMESTAMP, $this->getRequestUri());
        $this->assertEquals(self::KEY, $this->getRequestAuthentication());
        $this->assertEquals(self::CONTENT_TYPE, $this->getRequestContentType());
        $this->assertEquals($expected['signature'], $this->getRequestSignature());
    }

    /**
     * Get Category Editions
     */
    public function testGetCategoryEditions()
    {
        $this->publisher->getCategoryEditions();

        $expected = [
            'method'    => 'GET',
            'uri'       => 'categoryEditions',
            'signature' => 'zvX0DcmsyQq3N+b0FTUPS88FSPuWDMN2Ghe56A/LDg4=',
            'body'      => '',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Category Edition
     */
    public function testCreateCategoryEdition()
    {
        $this->publisher->createCategoryEdition([
            'code'              => 'CATEGORY_EXAMPLE',
            'editionId'         => '72',
            'publicationNodeId' => '58',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'categoryEditions',
            'signature' => 'qHkXM1Q5wOL/6XbPZNwlnKV1NYXXFAB7JiXmy+H9GU8=',
            'body'      => $this->loadXML('createCategoryEdition'),
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Delete Category Edition
     */
    public function testDeleteCategoryEdition()
    {
        $this->publisher->deleteCategoryEdition([ "publicationNodeId" => 12345, "code" => "category_code" ]);

        $expected = [
            'method'    => 'DELETE',
            'uri'       => 'categoryEditions',
            'signature' => 'DtixtaHhs2p1fV4OORPcD3Deob2DjVfi4LaYTT9HcG0=',
            'body'      => '',
        ];

        $this->assertEquals($expected['method'], $this->getRequestMethod());
        $this->assertEquals(self::SERVICE_URL . $expected['uri'] . "?publicationNodeId=12345&code=category_code&timestamp=" . self::TIMESTAMP, $this->getRequestUri());
        $this->assertEquals(self::KEY, $this->getRequestAuthentication());
        $this->assertEquals(self::CONTENT_TYPE, $this->getRequestContentType());
        $this->assertEquals($expected['signature'], $this->getRequestSignature());
    }

    /**
     * Get Third Party Subscriber Id
     */
    public function testGetThirdPartySubscriberId()
    {
        $this->publisher->getThirdPartySubscriberId([ "token" => "test.user@example.com", "editionId" => 12345]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'thirdPartySubscribers',
            'signature' => '21cFLKEgKrGCHjdfmOU6ylT57n5OKNuYk1TzKlCmTYM=',
            'body'      => $this->loadXML('getThirdPartySubscriberId'),
        ];

        $this->confirmRequest($expected);
    }
}

