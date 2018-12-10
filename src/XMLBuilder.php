<?php

namespace Bibby\Publisher;

use DOMDocument;

/**
 * XMLBuilder
 *
 * This class assists in building up XML strings in the format expected when
 * making POST / PUT requests to the YUDU Publisher REST API.
 */
class XMLBuilder {

    /**
     * Reader
     *
     * Builds expected XML for creating/updating a reader
     *
     * @param $data
     * @param $id
     * @return string
     */
    public static function reader($data, $id = null)
    {
        $dom = new DomDocument();

        $reader = $dom->createElementNS('http://schema.yudu.com', "reader");

        if($id){
            $reader->setAttribute("id", $id);
        }

        $dom->appendChild($reader);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->appendChild($dom->createTextNode($value));
            $reader->appendChild($element);
        }

        return $dom->saveXML();
    }

    /**
     * Create Permission
     *
     * Builds expected XML for creating a permission
     *
     * @param $data
     * @return string
     */
    public static function createPermission($data)
    {
        $dom = new DomDocument();

        $permission = $dom->createElementNS('http://schema.yudu.com', "permission");

        $dom->appendChild($permission);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->setAttribute("id", $value);
            $permission->appendChild($element);
        }

        return $dom->saveXML();
    }

    /**
     * Update Permission
     *
     * Builds expected XML for updating a permission
     *
     * @param $data
     * @return string
     */
    public static function updatePermission($data, $id)
    {
        $dom = new DomDocument();

        $permission = $dom->createElementNS('http://schema.yudu.com', "permission");

        $permission->setAttribute("id", $id);

        $dom->appendChild($permission);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->appendChild($dom->createTextNode($value));
            $permission->appendChild($element);
        }

        return $dom->saveXML();
    }

    /**
     * Create Subscription Period
     *
     * Builds expected XML for creating a subscription period
     *
     * @param $data
     * @return string
     */
    public static function createSubscriptionPeriod($data)
    {
        $dom = new DomDocument();

        $subscriptionPeriod = $dom->createElementNS('http://schema.yudu.com', "subscriptionPeriod");

        $dom->appendChild($subscriptionPeriod);

        // Add required reader element
        $reader = $dom->createElement('reader');
        $reader->setAttribute("id", $data['reader']);
        $subscriptionPeriod->appendChild($reader);

        // Add required subscription element
        $subscription = $dom->createElement('subscription');
        $subscription->setAttribute("id", $data['subscription']);
        $subscriptionPeriod->appendChild($subscription);

        // Add required startDate element
        $startDate = $dom->createElement('startDate');
        $startDate->appendChild($dom->createTextNode($data['startDate']));
        $subscriptionPeriod->appendChild($startDate);

        // Add optional expiry date
        if($data['expiryDate']){
            $expiryDate = $dom->createElement('expiryDate');
            $expiryDate->appendChild($dom->createTextNode($data['expiryDate']));
            $subscriptionPeriod->appendChild($expiryDate);
        }

        return $dom->saveXML();
    }

    /**
     * Update Subscription Period
     *
     * Builds expected XML for updating a subscription period
     *
     * @param $data
     * @return string
     */
    public static function updateSubscriptionPeriod($id, $data)
    {
        $dom = new DomDocument();

        $subscriptionPeriod = $dom->createElementNS('http://schema.yudu.com', "subscriptionPeriod");

        $subscriptionPeriod->setAttribute("id", $id);

        $dom->appendChild($subscriptionPeriod);

        foreach($data as $key => $value)
        {
            $element = $dom->createElement($key);
            $element->appendChild($dom->createTextNode($value));
            $subscriptionPeriod->appendChild($element);
        }

        return $dom->saveXML();
    }

    /**
     * Authenticate Password
     *
     * Builds expected XML for Authenticating a readers password
     *
     * @param $password
     * @return string
     */
    public static function authenticatePassword($password)
    {
        $dom = new DomDocument();

        $authentication = $dom->createElementNS('http://schema.yudu.com', 'authentication');

        $dom->appendChild($authentication);

        $pass = $dom->createElement('password');
        $pass->appendChild($dom->createTextNode($password));
        $authentication->appendChild($pass);

        return $dom->saveXML();
    }

    /**
     * Create Token
     *
     * Builds expected XML for creating an SSO token
     *
     * @param $key
     * @return string
     */
    public static function createToken($id)
    {
        $dom = new DomDocument();

        $authToken = $dom->createElementNS('http://schema.yudu.com', "authToken");

        $dom->appendChild($authToken);

        $key = $dom->createElement('key');
        $key->appendChild($dom->createTextNode($id));
        $authToken->appendChild($key);

        return $dom->saveXML();
    }
}


