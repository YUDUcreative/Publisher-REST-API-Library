[![Build Status](https://travis-ci.org/YUDUcreative/Publisher-REST-API-Library.svg?branch=master)](https://travis-ci.org/YUDUcreative/Publisher-REST-API-Library)
[![Latest Stable Version](https://poser.pugx.org/yudu/publisher/v/stable)](https://packagist.org/packages/yudu/publisher)
[![Total Downloads](https://poser.pugx.org/yudu/publisher/downloads)](https://packagist.org/packages/yudu/publisher)
[![License](https://poser.pugx.org/yudu/publisher/license)](https://packagist.org/packages/yudu/publisher)


## YUDU Publisher REST API Wrapper Library

This repository is a convenient wrapper library in PHP used to interact with the YUDU Publisher REST API. The library enables simple access to the YUDU Publisher REST API via convenient and simple to use helper methods. 

The building of request headers and signatures is abstracted away to make working with the API straightforward. 

To gain a deeper understanding of the YUDU publisher REST API please see [here](https://github.com/yudugit/rest-api-documentation) for more details.

This library is intended as an example to assist developers in their interaction with the YUDU Rest API. The creators are not liable for how the library is used and as such it is the responsibility of any users of the library to ensure the testing and resilience of their own production systems. 

## Installation 

This library can simply be installed with composer via packagist by using: 

``` composer require yudu/publisher ```

If unfamiliar with composer more information can be found [here](https://getcomposer.org/)

### How to get started?

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

### Get all readers
```
$results = $publisher->getReaders();
```
### Get reader
```
$results = $publisher->getReader(123456);
```
### Create reader
```
$results = $publisher->createReader([
    "username"      => "example",
    "emailAddress"  => "example@example.com",
    "firstName"     => "Micky",
    "lastName"      => "Jackson",
    "password"      => "NvrrL@nd!",
    "nodeId"        => "347358",
]);
```
### Update reader
```
$results = $publisher->updateReader(12464367,[
    "username"       => "updated",
    "emailAddress"   => "updated@example.com",
    "firstName"      => "Joe",
    "lastName"       => "Bloggs",
    "password"       => "GIU^&Gkdk24",
    "nodeId"         => "347358",
]);
```
### Delete reader
```
$results = $publisher->deleteReader(123456);
```

### Handling responses

After making a call to Publisher a ResponseHandler object is returned. The Responsehandler is a wrapped Guzzle response which reveals convenient methods to assist in transforming the response into a chosen format.

Below demonstrates the methods that can be used after making a request:

```

    // Makes request for readers ($results is a ResponseHandler Object)
    $results = $publisher->getReaders();
        
    // Get the request HTTP status code e.g 200
    $status = $results->statusCode();   
    
    // Convert results to Simple XML Object 
    $xml_object = $results->xml 
    
    // Convert results to XML string
    $xml_string = $results->xmlString();
    
    // Return the raw guzzle object
    $guzzle = $results->guzzle();
    
    // Casts results to string 
    header("Content-type: text/xml");
    echo $results; 
    
```

### Issues / Support

General support issues can be directed to [support@yudu.com](support@yudu.com)

If you encounter a bug or have a technical question please open an issue on this repository.