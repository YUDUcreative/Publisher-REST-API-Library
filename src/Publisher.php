<?php

namespace Yudu\Publisher;

use GuzzleHttp\Client;

/**
 * Publisher
 *
 * A YUDU Publisher REST API Wrapper Library in PHP
 *
 * @package   yudu/publisher
 * @author    Andrew James Bibby
 * @license   MIT License
 * @link      https://github.com/YUDUcreative/Publisher-REST-API-Library
 *
 * Publisher class methods are convenient and simple methods which can be used to make
 * calls without building the requests manually. All methods mirror available API
 * endpoints as detailed in the YUDU Publisher API documentation at:
 * https://github.com/yudugit/rest-api-documentation#uri-summary
 */
class Publisher extends RequestHandler {

    /**
     * Publisher constructor.
     *
     * @param  string  $key
     * @param  string  $secret
     * @param  array  $options
     * @param  string  $version
     * @param  \GuzzleHttp\Client|null  $client
     */
    public function __construct(string $key, string $secret, array $options = [], string $version = '2.1', Client $client = null)
    {
        parent::__construct(...func_get_args());
    }

    /**
     * Get Links
     *
     * Returns a list of links to the other available URIs
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\Publisher|\Yudu\Publisher\ResponseHandler
     */
    public function getLinks()
    {
        return $this->method('GET')->resource('')->make();
    }

    /**
     * Get Reader
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getReader(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("readers/$id")->make();
    }

    /**
     * Get Readers
     *
     * Returns a list of readers
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getReaders(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource('readers')->query($query)->make();
    }

    /**
     * Create Reader
     *
     * Creates a new Publisher Reader
     *
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createReader(array $data): ResponseHandler
    {
        $xml = XMLBuilder::createReader($data);
        return $this->method('POST')->resource('readers')->data($xml)->make();
    }

    /**
     * Update Reader
     *
     * Updates a Publisher Reader
     *
     * @param  string  $id
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function updateReader(string $id, array $data): ResponseHandler
    {
        $xml = XMLBuilder::updateReader($id, $data);
        return $this->method('PUT')->resource('readers/' . $id)->data($xml)->make();
    }

    /**
     * Delete Reader
     *
     * Deletes a Publisher Reader
     *
     * @param string $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deleteReader(string $id): ResponseHandler
    {
        return $this->method('DELETE')->resource('readers/' . $id)->make();
    }

    /**
     * Get Editions
     *
     * Returns a list of editions
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getEditions(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource('editions')->query($query)->make();
    }

    /**
     * Get Edition
     *
     * Returns a specific edition
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getEdition(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("editions/$id" )->make();
    }

    /**
     * Create Edition
     *
     * Creates a new Publisher Edition
     *
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createEdition(array $data): ResponseHandler
    {
        $xml = XMLBuilder::createEdition($data);
        return $this->method('POST')->resource('editions')->data($xml)->make();
    }

    /**
     * Update Edition
     *
     * Updates a  Publisher Edition
     *
     * @param  string  $id
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function updateEdition(string $id, array $data): ResponseHandler
    {
        $xml = XMLBuilder::createEdition($data);
        return $this->method("PUT")->resource("editions/$id")->data($xml)->make();
    }

    /**
     * Delete Edition
     *
     * Deletes a Publisher Edition
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deleteEdition(string $id): ResponseHandler
    {
        return $this->method('DELETE')->resource('editions/' . $id)->make();
    }

    /**
     * Get Permissions
     *
     * Lists edition permissions by reader
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getPermissions(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("permissions")->query($query)->make();
    }

    /**
     * Get Permission
     *
     * Retrieves a specific permission
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getPermission(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("permissions/$id")->make();
    }

    /**
     * Create Permission
     *
     * Creates a new permission for a reader
     *
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createPermission(array $data): ResponseHandler
    {
        $xml = XMLBuilder::createPermission($data);
        return $this->method('POST')->resource('permissions')->data($xml)->make();
    }

    /**
     * Update Permission
     *
     * Updates a readers permission
     *
     * @param  string  $id
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function updatePermission(string $id, array $data): ResponseHandler
    {
        $xml = XMLBuilder::updatePermission($id, $data);
        return $this->method('PUT')->resource("permissions/$id")->data($xml)->make();
    }

    /**
     * Delete Permission
     *
     * Deletes permission for a reader
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deletePermission(string $id): ResponseHandler
    {
        return $this->method('DELETE')->resource('permissions/' . $id)->make();
    }

    /**
     * Get Reader Logins
     *
     * Retrieves all reader logins
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getReaderLogins(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("readerLogins")->query($query)->make();
    }

    /**
     * Get Reader Login
     *
     * Retrieves a reader login
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getReaderLogin(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("readerLogins/$id")->make();
    }

    /**
     * Get Publications
     *
     * Retrieves list of Publications
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\Publisher|\Yudu\Publisher\ResponseHandler
     */
    public function getPublications(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("publications")->query($query)->make();
    }

    /**
     * Get Publication
     *
     * Retrieves a single Publication
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getPublication(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("publications/$id")->make();
    }

    /**
     * Get Subscriptions
     *
     * Retrieves all Subscriptions
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getSubscriptions(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("subscriptions")->query($query)->make();
    }

    /**
     * Get Subscription
     *
     * Retrieves a single Subscription
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getSubscription(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("subscriptions/$id")->make();
    }

    /**
     * Get Subscription Periods
     *
     * Retrieves all subscription periods
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getSubscriptionPeriods(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("subscriptionPeriods")->query($query)->make();
    }

    /**
     * Get Subscription Period
     *
     * Retrieves a single subscription period
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getSubscriptionPeriod(string $id): ResponseHandler
    {
        return $this->method('GET')->resource("subscriptionPeriods/$id")->make();
    }

    /**
     * Create Subscription Period
     *
     * Creates a new subscription period
     *
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createSubscriptionPeriod(array $data): ResponseHandler
    {
        $xml = XMLBuilder::createSubscriptionPeriod($data);
        return $this->method('POST')->resource("subscriptionPeriods")->data($xml)->make();
    }

    /**
     * Update Subscription Period
     *
     * Updates a specified subscription period
     *
     * @param  string  $id
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function updateSubscriptionPeriod(string $id, array $data): ResponseHandler
    {
        $xml = XMLBuilder::updateSubscriptionPeriod($id, $data);
        return $this->method('PUT')->resource("subscriptionPeriods/$id")->data($xml)->make();
    }

    /**
     * Delete Subscription Period
     *
     * Deletes a readers Subscription Period
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deleteSubscriptionPeriod(string $id): ResponseHandler
    {
        return $this->method('DELETE')->resource("subscriptionPeriods/$id")->make();
    }

    /**
     * Remove Devices
     *
     * Removes all authorised devices for a user
     *
     * @param  string  $id
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function removeDevices(string $id): ResponseHandler
    {
        return $this->method('DELETE')->resource("readers/$id/authorisedDevices")->make();
    }

    /**
     * Authenticate Password
     *
     * Authenticates a reader's password
     *
     * @param  string  $id
     * @param  string  $password
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function authenticatePassword(string $id, string $password): ResponseHandler
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
     * @param  string  $userId
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createToken(string $userId): ResponseHandler
    {
        $xml = XMLBuilder::createToken($userId);
        return $this->method('POST')->resource('token')->data($xml)->make();
    }

    /**
     * Create Publication Token
     *
     * Creates Single Sign On Token
     * Token will authenticate for editions at given Publication
     *
     * @param  string  $userId
     * @param  string  $publicationId
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createPublicationToken(string $userId, string $publicationId): ResponseHandler
    {
        $xml = XMLBuilder::createToken($userId);
        return $this->method('POST')->resource("publications/$publicationId/token")->data($xml)->make();
    }

    /**
     * Create Edition Token
     *
     * Creates Single Sign On Token
     * Token will authenticate for the edition only
     *
     * @param  string  $userId
     * @param  string  $editionId
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createEditionToken(string $userId, string $editionId): ResponseHandler
    {
        $xml = XMLBuilder::createToken($userId);
        return $this->method('POST')->resource("editions/$editionId/token")->data($xml)->make();
    }

    /**
     * Send Targeted Notifications
     *
     * Sends out a targeted notification to specified subscribers
     * Send Custom Notifications permission is required in
     * order to send targeted notifications.
     *
     * @param  string  $nodeId
     * @param  string  $title
     * @param  string  $message
     * @param  array  $subscribers
     * @param  array  $thirdPartySubscribers
     * @param  string  $priority
     * @param  bool  $disableSound
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function sendTargetedNotification(
        string $nodeId,
        string $title,
        string $message,
        array $subscribers,
        array $thirdPartySubscribers,
        string $priority,
        bool $disableSound = false
    ): ResponseHandler
    {
        $xml = XMLBuilder::targetedNotification($nodeId, $title, $message, $subscribers, $thirdPartySubscribers, $priority, $disableSound);
        return $this->method('POST')->resource('targetedNotifications')->data($xml)->make();
    }

    /**
     * Get Categories
     *
     * Returns Publisher Categories List
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getCategories(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("categories")->query($query)->make();
    }

    /**
     * Create Category
     *
     * Creates a Publisher Category
     *
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\Publisher|\Yudu\Publisher\ResponseHandler
     */
    public function createCategory(array $data): ResponseHandler
    {
        $xml = XMLBuilder::createCategory($data);
        return $this->method('POST')->resource('categories')->data($xml)->make();
    }

    /**
     * Delete Categories
     *
     * Removes ALL Categories at a specific publication node
     *
     * @param  string  $publicationNode
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deleteCategories(string $publicationNode): ResponseHandler
    {
        return $this->method('DELETE')->resource("categories")->query(['publicationNodeId' => $publicationNode])->make();
    }

    /**
     * Get Category
     *
     * Returns specific category by category code
     *
     * @param  string  $code
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getCategory(string $code): ResponseHandler
    {
        return $this->method('GET')->resource("categories/$code")->make();
    }

    /**
     * Update Category
     *
     * Updates a specific category at a specific publication node
     *
     * @param  string  $code
     * @param  string  $publicationNode
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function updateCategory(string $code, string $publicationNode, array $data): ResponseHandler
    {
        $xml = XMLBuilder::createCategory($data);
        return $this->method('PUT')->resource("categories/$code")->data($xml)->query(['publicationNodeId' => $publicationNode])->make();
    }

    /**
     * Delete Category
     *
     * Removes a category at a specific publication node
     *
     * @param  string  $code
     * @param  string  $publicationNode
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deleteCategory(string $code, string $publicationNode): ResponseHandler
    {
        return $this->method('DELETE')->resource("categories/$code")->query(['publicationNodeId' => $publicationNode])->make();
    }

    /**
     * Get Category Editions
     *
     * Returns list of category editions
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function getCategoryEditions(array $query = []): ResponseHandler
    {
        return $this->method('GET')->resource("categoryEditions")->query($query)->make();
    }

    /**
     * Create Category Edition
     *
     * Creates a Publisher Category Edition
     *
     * @param  array  $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function createCategoryEdition(array $data): ResponseHandler
    {
        $xml = XMLBuilder::createCategoryEdition($data);
        return $this->method('POST')->resource('categoryEditions')->data($xml)->make();
    }

    /**
     * Delete Category Edition
     *
     * Removes a category edition
     *
     * @param  array  $query
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yudu\Publisher\Exceptions\PublisherException
     * @return \Yudu\Publisher\ResponseHandler
     */
    public function deleteCategoryEdition(array $query = []): ResponseHandler
    {
        return $this->method('DELETE')->resource("categoryEditions")->query($query)->make();
    }

}


