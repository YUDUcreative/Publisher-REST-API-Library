<?php

require 'vendor/autoload.php';

use Bibby\Publisher\Publisher;

//$key = 'xgde6I0kW6hkhBZiM7yH6YOE5s06UW0bF9mBDh20WqCAtbk4S3g4IKKGBNBw8lxR';
//$secret = 'NLOCY0ZxF470kQiiNLTV54elxmi7EviZiF0v7P59w1VGkfBOLZwRxa1vXNbKExaH';

$key = 'icPm8MggNaxfMC4Sz5KheccAKvkTkKoXXPcaeKKw98658OchyEK1iCH6vTsPivbq';
$secret = 'tw4KrAsGfZ5HaDzKmxjb3v5bn2K0lWcJCcckrPwEUj2d0ILWLNtKO7NZ7dOIDfhP';

$node = '6821658';

// Create a unique string
$uniqid = uniqid();

$publisher = new Publisher($key, $secret);

$results = $publisher->createPermission([
        "reader" => "126371204",
        "edition" => "6795595",
    ]);


$xml = simplexml_load_string($results->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);

echo "<pre>";
echo htmlentities($xml->asXML());
echo "</pre>";