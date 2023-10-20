## YUDU Publisher REST API Wrapper Library 1.0.0

[![Build Status](https://travis-ci.org/YUDUcreative/Publisher-REST-API-Library.svg?branch=master)](https://travis-ci.org/YUDUcreative/Publisher-REST-API-Library)
[![Latest Stable Version](https://poser.pugx.org/yudu/publisher/v/stable)](https://packagist.org/packages/yudu/publisher)
[![Total Downloads](https://poser.pugx.org/yudu/publisher/downloads)](https://packagist.org/packages/yudu/publisher)
[![License](https://poser.pugx.org/yudu/publisher/license)](https://packagist.org/packages/yudu/publisher)

This repository is a convenient wrapper library in PHP used to interact with the YUDU Publisher REST API. The library enables simple access to the YUDU Publisher REST API via convenient and simple to use helper methods. 

The building of request headers and signatures is abstracted away to make working with the API straightforward. 

To gain a deeper understanding of the YUDU publisher REST API please see [here](https://github.com/yudugit/rest-api-documentation) for more details.

This library is intended as an example to assist developers in their interaction with the YUDU Rest API. The creators are not liable for how the library is used and as such it is the responsibility of any users of the library to ensure the testing and resilience of their own production systems. 

## Installation 

This library can simply be installed with composer via packagist by using: 

``` composer require yudu/publisher ```

If unfamiliar with composer more information can be found [here](https://getcomposer.org/)

## How to get started?

To use this library you will need an active YUDU Publisher Key and Secret. The Key and Secret are required to create a Publisher client. Once instantiated the Publisher client can be used for multiple requests. The results can be transformed as required. Below demonstrates how the publisher client can be created and used.

```
<?php
    
require 'vendor/autoload.php';

use Yudu\Publisher\Publisher;

// YUDU Publisher Credentials
$key = 'your-key-here';
$secret = 'your-secret-here';

// Optional
$options = [
    'debug' => false,    // raw requests/response returned for debugging
    'verify' => true,    // toggle SSL verification 
];

// Create Publisher Client
$publisher = new Publisher($key, $secret, $options);  

// Makes request for readers
$results = $publisher->getReaders();

// Print the result object (see responses section for how to manage responses) 
print_r($results);
    
?>
```

## Available methods and examples 

#### Get Links
```
$publisher->getLinks();
```

#### Get all readers
```
$publisher->getReaders();
```
#### Get reader
```
$publisher->getReader(123456);
```
#### Create reader
```
$publisher->createReader([
    "username"      => "example",
    "emailAddress"  => "example@example.com",
    "firstName"     => "Micky",
    "lastName"      => "Jackson",
    "password"      => "NvrrL@nd!",
    "nodeId"        => "347358",
]);
```
#### Update reader
```
$publisher->updateReader(12464367,[
    "username"       => "updated",
    "emailAddress"   => "updated@example.com",
    "firstName"      => "Joe",
    "lastName"       => "Bloggs",
    "password"       => "GIU^&Gkdk24",
    "nodeId"         => "347358",
]);
```
#### Delete reader
```
$publisher->deleteReader(123456);
```
#### Get Editions
```
$publisher->getEditions();
```
#### Get Edition
```
$publisher->getEdition(12345);
```
#### Create Edition
```
$publisher->createEdition([
    "name" => "My Edition",
    "onDeviceName" => "My Edition",
    "shortName" => "MY1",
    "targetState" => [
        "web" => "LIVE",
    ],
    "documentUrl" => "https://s3-eu-west-1.amazonaws.com/my.account/test/example.pdf",
    "publicationNodeId" => "4325325",
    "pageBillingType" => "PLATFORM"
]);
```
#### Update Edition
```
$publisher->updateEdition(6894180, [
    "name" => "My Edition",
    "onDeviceName" => "My Edition",
    "shortName" => "My Edition",
    "drmEnabled" => "true",
    "iosSaleOption" => "FREE",
    "androidSaleOption" => "FREE",
    "enableSharingByEmail" => "false",
    "enablePrinting" => "true",
    "targetState" => [
        "web" => "LIVE",
    ],
    "pageBillingType" => "PLATFORM"
]);
```
#### Delete Edition
```
$publisher->deleteEdition(371457);
```
#### Get Permissions
```
$publisher->getPermissions();
```
#### Get Permission
```
$publisher->getPermission(16346);
```
#### Create Permission
```
$publisher->createPermission([
    'reader'     => 2356346,
    'edition'    => 6795595,
    'expiryDate" => "2024-06-01T00:00:00Z'
]);
```
#### Update Permission
```
$publisher->updatePermission(132365, [
    'expiryDate' => '2024-06-01T00:00:00Z'
]);
```
#### Delete Permission
```
$publisher->deletePermission(1443904)
```
#### Get Reader Logins
``` 
$publisher->getReaderLogins();
```
#### Get reader Login
``` 
$publisher->getReaderLogin(12345);
```
#### Get Publications
```
$publisher->getPublications();
```
#### Get Publication
```
$publisher->getPublication(6821658);
```
#### Get Subscriptions
```
$publisher->getSubscriptions();
```
#### Get Subscription
```
$publisher->getSubscription(45678656);
```
#### Get Subscription Periods
``` 
$publisher->getSubscriptionPeriods();
```
#### Get Subscription Period
```
$publisher->getSubscriptionPeriod(968518080);
```
#### Create Subscription Period
```
$publisher->createSubscriptionPeriod([
    'reader'       => 126417872,
    'subscription' => 6482745,
    'startDate'    => '2019-01-11T00:00:00Z',
    'expiryDate'   => '2020-01-11T00:00:00Z',
]);
```
#### Update Subscription Period
```
$publisher->updateSubscriptionPeriod(2351346 [
    'startDate'    => '2020-01-11T00:00:00Z',
    'expiryDate'   => '2021-01-11T00:00:00Z',
]);
```
#### Delete Subscription Period
```
$publisher->deleteSubscriptionPeriod(2351346);
```
#### Remove Devices
```
$publisher->removeDevices(6134634);
```
#### Authenticate Password
```
$publisher->authenticatePassword(2363465,'j@Cks50n');
```
#### Create Token (Access to any edition)
```
$publisher->createToken('admin@example.com');
```
#### Create Publication Token (Access editions at publication) 
```
$publisher->createPublicationToken('admin@exmaple.com', 1246457);
```
#### Create Edition Token (Access single edition only)
```
$publisher->createEditionToken('admin@exmaple.com', 74244556);
```
#### Send Targeted Notification
```
$publisher->sendTargetedNotification(7145646, 'title', 'message', ['admin@example.com'], [ 356h64gqh65h545vhj6, 4574655w5ujw65w5a5], 'HIGH', 'false');
```
#### Get Categories
```
$publisher->getCategories();
```
#### Create Category
```
$publisher->createCategory([
    'categoryTitle'     => 'How to build a time machine',
    'code'              => 'adventure',
    'containsAll'       => 'true',
    'defaultCategory'   => 'false',
    'ordering'          => '4',
    'publicationNodeId' => '61',
]);
```
#### Delete ALL Categories (from specific node)
```
$publisher->deleteCategories('124252');
```
#### Get Specific Category
```
$publisher->getCategories('adventure');
```
#### Update Category
```
$publisher->updateCategory([
    'categoryTitle'     => 'Do you remember the time?',
    'code'              => 'adventure',
    'containsAll'       => 'true',
    'defaultCategory'   => 'false',
    'ordering'          => '4',
    'publicationNodeId' => '61',
]);
```
#### Delete Category
```
$publisher->deleteCategory('adventure', '61');
```
#### Get Category Editions
```
$publisher->getCategoryEditions();
```
#### Create Category Edition
```
$publisher->createCategoryEdition([
    'code'              => 'adventure',
    'editionId'         => '64562',
    'publicationNodeId' => '61',
]);
```
#### Delete Category Edition
```
$publisher->deleteCategoryEdition([
    'publicationNodeId' => '61'
    'code'              => 'adventure'
]);
```

## Custom Request

In addition to using the methods above, it may be desirable to build the request manually. If this is the case the underlying request methods are exposed and chainable so that any request can be made. It doesnt matter what order the chained methods are added so long as the make() method is that last method to be called. 

For example:

```
$results = $publisher->method("GET")->resource("readers")->make();
```

## Handling responses

After making a call to Publisher a ResponseHandler object is returned. The Responsehandler is a wrapped Guzzle response which reveals convenient methods to assist in transforming the response into a chosen format.

Below demonstrates the methods that can be used after making a request:

```
// Makes request for readers ($results is a ResponseHandler Object)
$results = $publisher->getReaders();

// An array of request information
$results = $results->request();

// A GuzzleHttp Response
$results = $results->response();

// Get the request HTTP status code e.g 200
$status = $results->statusCode();   

// Convert results to Simple XML Object 
$xml_object = $results->xml()

// Convert results to XML string
$xml_string = $results->xmlString();

// Return the raw guzzle object
$guzzle = $results->guzzle();

// Return raw http request/response string
$raw = $results->raw();

// Echo Casts results to string 
header("Content-type: text/xml");
echo $results; 
```

## Issues / Support

General support issues can be directed to [support@yudu.com](support@yudu.com)

When requesting support it will be helpful if you can provide the raw requests and responses for any api call you are attempting. This can be obtained by passing ``` [ 'debug' => true ] ``` in the options array when instantiating the publisher library.

If you encounter a bug or have a technical question please open an issue on this repository.
