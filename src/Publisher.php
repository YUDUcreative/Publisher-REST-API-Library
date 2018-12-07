<?php

namespace Bibby\Publisher;

/**
 * Publisher
 *
 * A YUDU Publisher REST API Wrapper Library
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

        return $this->get()->resource($resource)->query($query)->make()->format();
    }

    /**
     * Create Permission
     *
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
     * Update Permission
     *
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
     * Delete Permission
     *
     * Deletes permission for a reader
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
     * Retreives all reader logins
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
     * Retreives list of Publications
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
     * Retrieves all Subscriptions
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



    // TODO targeted push notifications

    // TODO SSO tokens...

}


