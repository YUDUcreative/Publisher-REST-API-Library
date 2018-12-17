<?php

namespace Bibby\Publisher;

use Bibby\Publisher\Exceptions\PublisherException;
use Bibby\Publisher\RequestHandler;
use Bibby\Publisher\ResponseHandler;
use Bibby\Publisher\XMLBuilder;
use GuzzleHttp\Client;

/**
 * Publisher
 *
 * A YUDU Publisher REST API Wrapper Library in PHP
 *
 * @package   bibby/publisher
 * @author    Andrew James Bibby
 * @license   MIT License
 * @version   0.0.1
 * @link      https://github.com/YUDUcreative/Publisher-REST-API-Library
 *
 * Publisher class methods are convenient and simple methods which can be used to make
 * calls without building the requests manually. All methods mirror available API
 * endpoints as detailed in the YUDU Publisher API documentation at:
 * https://github.com/yudugit/rest-api-documentation#uri-summary
 */
class Publisher extends RequestHandler {

    /**
     * Request constructor.
     *
     * @param $key
     * @param $secret
     * @param $options
     * @param $client
     * @throws \Exception
     */
    public function __construct($key, $secret, Array $options = [], \GuzzleHttp\Client $client = null)
    {
        parent::__construct(...func_get_args());
    }

    /**
     * Get Links
     *
     * Returns a list of links to the other available URIs
     */
    public function getLinks()
    {
        return $this->method('GET')->resource('')->make();
    }

    /**
     * Get Reader
     *
     * Returns a Publisher reader
     * @param null $id
     */
    public function getReader($id)
    {
        return $this->method('GET')->resource("readers/$id")->make();
    }

    /**
     * Get Readers
     *
     * Returns a list of readers
     * @param array $query
     */
    public function getReaders($query = [])
    {
        return $this->method('GET')->resource('readers')->query($query)->make();
    }

    /**
     * Create Reader
     *
     * Creates a new Publisher Reader
     *
     * @param $data
     */
    public function createReader($data)
    {
        $xml = XMLBuilder::createReader($data);
        return $this->method('POST')->resource('readers')->data($xml)->make();
    }

    /**
     * Update Reader
     *
     * Updates a Publisher Reader
     *
     * @param $id
     * @param $data
     */
    public function updateReader($id, $data)
    {
        $xml = XMLBuilder::updateReader($id, $data);

        return $this->method('PUT')->resource('readers/' . $id)->data($xml)->make();
    }

    /**
     * Delete Reader
     *
     * Deletes a Publisher Reader
     *
     * @param $id
     */
    public function deleteReader($id)
    {
        return $this->method('DELETE')->resource('readers/' . $id)->make();
    }

    /**
     * Get Editions
     *
     * Returns a list of editions
     * @param array $query
     */
    public function getEditions($query = [])
    {
        return $this->method('GET')->resource('editions')->query($query)->make();
    }

    /**
     * Get Edition
     *
     * Returns a specific edition
     * @param $id
     */
    public function getEdition($id)
    {
        return $this->method('GET')->resource("editions/$id" )->make();
    }

    /**
     * Get Permissions
     *
     * Lists edition permissions by reader
     * @param array $query
     */
    public function getPermissions($query = [])
    {
        return $this->method('GET')->resource("permissions")->query($query)->make();
    }

    /**
     * Get Permission
     *
     * Retrieves a specific permission
     * @param $id
     */
    public function getPermission($id)
    {
        return $this->method('GET')->resource("permissions/$id")->make();
    }

    /**
     * Create Permission
     *
     * Creates a new permission for a reader
     *
     * @param array $data
     */
    public function createPermission($data)
    {
        $xml = XMLBuilder::createPermission($data);
        return $this->method('POST')->resource('permissions')->data($xml)->make();
    }

    /**
     * Update Permission
     *
     * @param $id
     * @param $data
     */
    public function updatePermission($id, $data)
    {
        $xml = XMLBuilder::updatePermission($id, $data);
        return $this->method('PUT')->resource("permissions/$id")->data($xml)->make();
    }

    /**
     * Delete Permission
     *
     * Deletes permission for a reader
     *
     * @param $data
     */
    public function deletePermission($id)
    {
        return $this->method('DELETE')->resource('permissions/' . $id)->make();
    }

    /**
     * Get Reader Logins
     *
     * Retreives all reader logins
     * @param array $query
     */
    public function getReaderLogins($query = [])
    {
        return $this->method('GET')->resource("readerLogins")->query($query)->make();
    }

    /**
     * Get Reader Login
     *
     * Retreives a reader login
     * @param $id
     */
    public function getReaderLogin($id)
    {
        return $this->method('GET')->resource("readerLogins/$id")->make();
    }

    /**
     * Get Publications
     *
     * Retreives list of Publications
     * @param array $query
     */
    public function getPublications($query = [])
    {
        return $this->method('GET')->resource("publications")->query($query)->make();
    }

    /**
     * Get Publication
     *
     * Retreives a single Publication
     * @param $id
     */
    public function getPublication($id)
    {
        return $this->method('GET')->resource("publications/$id")->make();
    }

    /**
     * Get Subscriptions TODO this returns 500 perhaps API bug why?
     *
     * Retrieves all Subscriptions
     * @param array $query
     */
    public function getSubscriptions($query = [])
    {
        return $this->method('GET')->resource("subscriptions")->query($query)->make();
    }

    /**
     * Get Subscription
     *
     * Retrieves a single Subscription
     * $id
     */
    public function getSubscription($id)
    {
        return $this->method('GET')->resource("subscriptions/$id")->make();
    }

    /**
     * Get Subscription Periods
     *
     * Retrieves all subscription periods
     */
    public function getSubscriptionPeriods($query = [])
    {
        return $this->method('GET')->resource("subscriptionPeriods")->query($query)->make();
    }

    /**
     * Get Subscription Period
     *
     * Retrieves a single subscription period
     */
    public function getSubscriptionPeriod($id)
    {
        return $this->method('GET')->resource("subscriptionPeriods/$id")->make();
    }

    /**
     * Create Subscription Period
     *
     * Creates a new subscription period
     */
    public function createSubscriptionPeriod($data)
    {
        $xml = XMLBuilder::createSubscriptionPeriod($data);
        return $this->method('POST')->resource("subscriptionPeriods")->data($xml)->make();
    }

    /**
     * Update Subscription Period
     *
     * Updates a specified subscription period
     */
    public function updateSubscriptionPeriod($id, $data)
    {
        $xml = XMLBuilder::updateSubscriptionPeriod($id, $data);
        return $this->method('PUT')->resource("subscriptionPeriods/$id")->data($xml)->make();
    }

    /**
     * Delete Subscription Period
     *
     * Deletes a readers Subscription Period
     *
     * @param $id
     */
    public function deleteSubscriptionPeriod($id)
    {
        return $this->method('DELETE')->resource("subscriptionPeriods/$id")->make();
    }

    /**
     * Remove Devices
     *
     * Removes all authorised devices for a user
     *
     * @param $id
     */
    public function removeDevices($id)
    {
        return $this->method('DELETE')->resource("readers/$id/authorisedDevices")->make();
    }

    /**
     * Authenticate Password
     *
     * Authenticates a reader's password
     *
     * @param $id
     * @param $password
     */
    public function authenticatePassword($id, $password)
    {
        $xml = XMLBuilder::authenticatePassword($password);
        return $this->method('PUT')->resource("readers/$id/authentication")->data($xml)->make();
    }

    /**
     * Create Token
     *
     * Creates Single Sign On Token
     * Token will authenticate for ANY edition
     *
     * @param $id
     */
    public function createToken($id)
    {
        $xml = XMLBuilder::createToken($id);
        return $this->method('POST')->resource('token')->data($xml)->make();
    }

    /**
     * Create Publication Token
     *
     * Creates Single Sign On Token
     * Token will authenticate for editions at given Publication
     *
     * @param $id
     * @param $publication
     */
    public function createPublicationToken($id, $publication)
    {
        $xml = XMLBuilder::createToken($id);
        return $this->method('POST')->resource("publications/$publication/token")->data($xml)->make();
    }

    /**
     * Create Edition Token
     *
     * Creates Single Sign On Token
     * Token will authenticate for the edition only
     *
     * @param $id
     * @param $edition
     */
    public function createEditionToken($id, $edition)
    {
        $xml = XMLBuilder::createToken($id);
        return $this->method('POST')->resource("editions/$edition/token")->data($xml)->make();
    }

    /**
     * Send Targeted Notifications
     *
     * Sends out a targeted notification to specified subscribers
     * Send Custom Notifications permission is required in
     * order to send targeted notifications.
     *
     * @param $nodeId
     * @param $title
     * @param $message
     * @param $subscribers
     */
    public function sendTargetedNotification($nodeId, $title, $message, $subscribers, $thirdPartySubscribers)
    {
        $xml = XMLBuilder::targetedNotification($nodeId, $title, $message, $subscribers, $thirdPartySubscribers);
        return $this->method('POST')->resource('targetedNotifications')->data($xml)->make();
    }

}


