<?php

require 'vendor/autoload.php';

use Bibby\Publisher\Publisher;

$key = 'xgde6I0kW6hkhBZiM7yH6YOE5s06UW0bF9mBDh20WqCAtbk4S3g4IKKGBNBw8lxR';
$secret = 'NLOCY0ZxF470kQiiNLTV54elxmi7EviZiF0v7P59w1VGkfBOLZwRxa1vXNbKExaH';

$node = '6821658';

$publisher = new Publisher($key, $secret, true);

// Get
//$results = $publisher->getEditions(6795595);

//$results = $publisher->updateReader(126384220, [
//    'emailAddress' => '54263@dfgh.com',
//    'username'     => 'fgbvvv',
//    'firstName'     => 'adfgaddf',
//    'lastName'     => 'adfgad',
//    'password'     => 'adfhahafjadfjadfja',
//]);

//$results = $publisher->deleteReader(126384220);
$results = $publisher->getLinks();

print_r($results);

//echo "<pre>";
//echo htmlentities($results->asXML());
//echo "</pre>";
