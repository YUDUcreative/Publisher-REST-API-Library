<?php

namespace Yudu\Publisher\Tests\Publisher;

use Yudu\Publisher\Tests\PublisherTestCase;

class PublisherTest extends PublisherTestCase
{
    private $publisher;

    public function setUp(){
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
            'signature' => '2M9n4MDsZrPgC6fQLicOui1uh2+s9KEJ+UdhP2m782A=',
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
            'signature' => 'kRvwEd8CsJUjPWCwAPInZAT4MJCC60edG+RE4G6RsH0=',
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
            'signature' => 'Sn1RDyoLl62ASRYN9v3vYWMv3HQCzDu+mA5oHzAjYxE=',
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
            'signature' => 'lYeAFXCt/ZT83YZja1vFm6FhDwquz1nBp5bMyLo5oag=',
            'body'      => $this->loadXML('createReader')
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
            'signature' => 'u47FPdtbDPprcVqUbjj3gz4P5rNV9jB7ssv1IsC/jqo=',
            'body'      => $this->loadXML('updateReader')
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
            'signature' => 'x1WjCyYSge49467gSnmk+CWErm9rlxqZvEL/Ajix38c=',
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
            'signature' => '14ZG7lAWtF4Iu4/Z05NWSgOa4QHUYuK6lXiWXQFhY9s=',
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
            'signature' => 'czuditXGyeKPy5UzMxbgZoBtfIZE5f60tLAi5tzmor8=',
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
            'signature' => 'KvVslm9cRgbg5PUtQLhWIYPsL2yjriropTOJeHAN7tY=',
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
            'signature' => 'otycvX+A6in4WG7PHLyOkGvt7YWs1frjQlKC3x/MMsI=',
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
            'signature' => 'nE7x3V1CZiVNdZLG2lmi3Ey2pQ/4hkGlC48opFFdyuc=',
            'body'      => $this->loadXML('createPermission')
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Update Permission
     */
    public function testUpdatePermission()
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
     * Delete Permission
     */
    public function testDeletePermission()
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
     * Get Reader Logins
     */
    public function testGetReaderLogins()
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
     * Get Reader Login
     */
    public function testGetReaderLogin()
    {
        $this->publisher->getReaderLogin(12345);

        $expected = [
            'method'    => 'GET',
            'uri'       => 'readerLogins/12345',
            'signature' => 'rb/jMW4sulh+VWiSWY2iUTNu4MU1YvlIqbH14xUdWxg=',
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
            'signature' => '5CAjuJTseacSkprZFnRKC6f0+WHivGa/6FgRUzJ6PWs=',
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
            'signature' => 'D/hzgfwmswf4p1Wv0KIA4BFtVU+DhutrtYCMegs0/KA=',
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
            'signature' => 'BZjXY3s82ASidPctyoV8RvyCAMgazBor0yzB/3eLvHY=',
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
            'signature' => 'b54QPFtq0zKjE8+o/yOURaPBglFuCX9fg/6oGKQDhN8=',
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
            'signature' => '88d9yO5qZFvK3w+e6qq64AHz5vrOdfKQrx2d/078EYk=',
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
            'signature' => 'Xww4CZet4IGxWWZb87y04MpIChQugH2VaemzJipRr0w=',
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Create Subscription Period
     */
    public function testCreateSubscriptionPeriod()
    {
        $this->publisher->createSubscriptionPeriod ([
            'reader'       => '1234',
            'subscription' => '9876',
            'startDate'    => '2014-11-01T00:00:00Z',
            'expiryDate'   => '2016-11-01T00:00:00Z',
        ]);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'subscriptionPeriods',
            'signature' => 'JkzerFPhIvq2koUyRdQ85JEwYKkQpgMK/JO/VQFC6l8=',
            'body'      => $this->loadXML('createSubscriptionPeriod')
        ];

        $this->confirmRequest($expected);
    }

    /**
     * Update Subscription Period
     */
    public function testUpdateSubscriptionPeriod()
    {
        $this->publisher->updateSubscriptionPeriod(1, [
            'startDate'    => '2014-11-01T00:00:00Z',
            'expiryDate'   => '2016-11-01T00:00:00Z',
        ]);

        $expected = [
            'method'    => 'PUT',
            'uri'       => 'subscriptionPeriods/1',
            'signature' => 'ySKUxGAIHwHtqm6fyBh2aOy1EIJbnODJTblIAjYkEPM=',
            'body'      => $this->loadXML('updateSubscriptionPeriod')
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
            'signature' => '0bskRVavJKlqq0Tx46Gz9GuyBFH085l2GBll9chHYss=',
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
            'signature' => 'sRVvFojkx/D3WIVtbu6N0LzUlt1ieRhdHO5n1YJbOsM=',
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
            'signature' => '9amqmnkCs/Sl6an49Nc5qzQKUQ2AOmydR+gRuR2qQDo=',
            'body'      => $this->loadXML('authenticatePassword')
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
            'signature' => 'Xp8ZZmAB26PTIM3cBpZSSvBxG+mClE4xuaRvX3ZVko4=',
            'body'      => $this->loadXML('createToken')
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
            'signature' => 'iNoWAX3Tgkmpu4EK8Tprc5mDh2taoIPKI84eRkGhMVM=',
            'body'      => $this->loadXML('createToken')
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
            'signature' => 'jz3mKFZS77mJ3NNY210JhdvtivjrwdXOUhzblwU8rFk=',
            'body'      => $this->loadXML('createToken')
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
        $subscribers = ['billy123', 'unclebob69', 'Mjaxson'];
        $thirdPartySubscribers = ['cnfvwh4p93jcllljfd', 'g5q456uyhb565hta5br', 'vb49ierd39jgvr939kkjd'];

        $this->publisher->sendTargetedNotification($nodeId, $title, $message, $subscribers, $thirdPartySubscribers);

        $expected = [
            'method'    => 'POST',
            'uri'       => 'targetedNotifications',
            'signature' => 'ZGYWNSvwrsmEUyhtQXD4FoaLjNG8e7h6fkxV1a2JpNY=',
            'body'      => $this->loadXML('sendTargetedNotification')
        ];

        $this->confirmRequest($expected);
    }

}

