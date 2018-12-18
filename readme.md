[![Build Status](https://travis-ci.org/YUDUcreative/Publisher-REST-API-Library.svg?branch=master)](https://travis-ci.org/YUDUcreative/Publisher-REST-API-Library)
[![Latest Stable Version](https://poser.pugx.org/yudu/publisher/v/stable)](https://packagist.org/packages/yudu/publisher)
[![Total Downloads](https://poser.pugx.org/yudu/publisher/downloads)](https://packagist.org/packages/yudu/publisher)
[![License](https://poser.pugx.org/yudu/publisher/license)](https://packagist.org/packages/yudu/publisher)


## YUDU Publisher REST API Wrapper Library

This repository is a convenient wrapper library in PHP used to interact with the YUDU Publisher REST API. The library enables simple access to YUDU Publisher API endpoints via convenient methods. The building of requests is abstracted away to make working with the API much simpler. 

To gain a deeper understanding of the YUDU publisher REST API please see:
 [https://github.com/yudugit/rest-api-documentation](https://github.com/yudugit/rest-api-documentation) for more details.

## Installation 

After downloading this repository, to install simply run ``` composer install ``` to install the required dependency files. The library depends on Guzzle to assist in making http requests. After installation ensure the library is autoloaded and used in any files requests are made.

## How to use?

Requests to Publisher can be made via various convenient helper methods. These abstract away all the request logic making everything easier. Below are some examples of how to work with the library.

### Retrieve a list of Publisher readers

```
// Create a Publisher Instance
$publisher = new Publisher('publisher-key', 'publisher-secret');

// Make request for all Readers
$results = $publisher->getReaders();

// Return the results of the API call
return $results; 
```

### Retrieve a specific Publisher reader

```
$results = $publisher->getReaders(123456);
```

### Delete a specific Publisher reader

```
$results = $publisher->deleteReader(123456);
```

### Create a new Publisher reader

```
$results = $publisher->createReader(
[
    "username" => "example",
    "emailAddress" => "example@example.com",
    "firstName" => "Micky",
    "lastName" => "Jackson",
    "password" => "NvrrL@nd!",
    "nodeId" => "347358",
]);
```

### Update a Publisher reader

```
$results = $publisher->updateReader( 12464367,
[
    "username" => "updated",
    "emailAddress" => "updated@example.com",
    "firstName" => "Joe",
    "lastName" => "Bloggs",
    "password" => "GIU^&Gkdk24",
    "nodeId" => "347358",
]);
```

