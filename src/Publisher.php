<?php

namespace Bibby\Publisher;

/**
 * Publisher
 *
 * A YUDU Publisher REST API Wrapper Library in PHP
 *
 * @package   bibby/publisher
 * @author    Andrew James Bibby <support@yudu.com>
 * @license   MIT License
 * @version   0.0.1
 * @link      https://github.com/YUDUcreative/Publisher-REST-API-Library
 *
 * Publisher class methods are convenient and simple methods which can be used to make
 * calls without building the requests manually. All methods mirror available API
 * endpoints as detailed in the YUDU Publisher API documentation at:
 * https://github.com/yudugit/rest-api-documentation#uri-summary
 */

class Publisher extends Request{

    /**
     * Publisher constructor
     *
     * Initilizes Publisher object
     *
     * @param $key
     * @param $secret
     * @param $debug
     * @param $verify
     */
    public function __construct($key, $secret, $debug = false, $verify = true)
    {
        parent::__construct($key, $secret, $debug, $verify);
    }

    /**
     * Get Links
     * // TODO this is broken.....
     * Returns a list of links to the other available URIs
     */
    public function getLinks()
    {
        return $this->method('OPTIONS')->resource('')->make();
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

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
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
        $xml = XMLBuilder::reader($data);

        return $this->method('POST')->resource('readers')->data($xml)->make()->format();
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
        $xml = XMLBuilder::reader($data, $id);

        return $this->method('PUT')->resource('readers/' . $id)->data($xml)->make()->format();
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
        return $this->method('DELETE')->resource('readers/' . $id)->make()->format();
    }

    /**
     * Get Editions
     *
     * Returns a list of editions
     *
     * @param $id
     * @param array $query
     */
    public function getEditions($id = null, $query = [])
    {
        $resource = $id ? "editions/$id" : "editions";

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
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

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
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

        return $this->method('POST')->resource('permissions')->data($xml)->make()->format();
    }

    /**
     * Update Permission
     *
     * TODO Updates a reader permission broken!
     *
     * @param $id
     * @param $data
     */
    public function updatePermission($id, $data)
    {
        $xml = XMLBuilder::updatePermission($data, $id);

        return $this->method('PUT')->resource('permissions/' . $id)->data($xml)->make()->format();
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
        return $this->method('DELETE')->resource('permissions/' . $id)->make()->format();
    }

    /**
     * Get Reader Logins
     *
     * Retreives all reader logins
     *
     * @param null $id
     * @param array $query
     */
    public function getReaderLogins($id = null, $query = [])
    {
        $resource = $id ? "readerLogins/$id" : "readerLogins";

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
    }

    /**
     * Get Publications
     *
     * Retreives list of Publications
     *
     * @param null $id
     * @param array $query
     */
    public function getPublications($id = null, $query = [])
    {
        $resource = $id ? "publications/$id" : "publications";

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
    }

    /**
     * TODO this returns 500 when retrieving ALL .... perhaps API bug why?
     * Get Subscriptions
     *
     * Retrieves all Subscriptions
     *
     * @param null $id
     * @param array $query
     */
    public function getSubscriptions($id = null, $query = [])
    {
        $resource = $id ? "subscriptions/$id" : "subscriptions";

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
    }

    /**
     * Get Subscription Periods
     *
     * Retrieves all subscription periods
     */
    public function getSubscriptionPeriods($id = null, $query = [])
    {
        $resource = $id ? "subscriptionPeriods/$id" : "subscriptionPeriods";

        return $this->method('GET')->resource($resource)->query($query)->make()->format();
    }

    /**
     * Create Subscription Period
     *
     * Creates a new subscription period
     */
    public function createSubscriptionPeriod($data){

        $xml = XMLBuilder::createSubscriptionPeriod($data);

        return $this->method('POST')->resource('subscriptionPeriods')->data($xml)->make()->format();
    }

    /**
     * Update Subscription Period
     *
     * Updates a specified subscription period
     */
    public function updateSubscriptionPeriod($id, $data){

        $xml = XMLBuilder::updateSubscriptionPeriod($id, $data);

        return $this->method('PUT')->resource('subscriptionPeriods/' . $id )->data($xml)->make()->format();
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
        return $this->method('DELETE')->resource('subscriptionPeriods/' . $id)->make()->format();
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
        return $this->method('DELETE')->resource('readers/' . $id . '/authorisedDevices')->make()->format();
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

        return $this->method('PUT')->resource('readers/' . $id . '/authentication')->data($xml)->make()->format();
    }

    /**
     * Create Token
     *
     * Creates Single Sign On Token
     * Token will authenticate for ANY edition
     *
     * @param $id
     */
    public function createToken($id){

        $xml = XMLBuilder::createToken($id);

        return $this->method('POST')->resource('token')->data($xml)->make()->format();
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
    public function createPublicationToken($id, $publication){

        $xml = XMLBuilder::createToken($id);

        return $this->method('POST')->resource('publications/' . $publication . '/token')->data($xml)->make()->format();
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
    public function createEditionToken($id, $edition){

        $xml = XMLBuilder::createToken($id);

        return $this->method('POST')->resource('editions/' . $edition . '/token')->data($xml)->make()->format();

    }

    // createEditionToken
    // createPublicationToken
    //
    // Single Edition Token



    // TODO SSO tokens...

    // TODO targeted push notifications

}


