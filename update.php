<?php

require 'vendor/autoload.php';

use Bibby\Publisher\Publisher;

$key = 'xgde6I0kW6hkhBZiM7yH6YOE5s06UW0bF9mBDh20WqCAtbk4S3g4IKKGBNBw8lxR';
$secret = 'NLOCY0ZxF470kQiiNLTV54elxmi7EviZiF0v7P59w1VGkfBOLZwRxa1vXNbKExaH';

$node = '6821658';

$publisher = new Publisher($key, $secret);


$results = $publisher->updatePermission(1424909, [
    "reader" => "126371204",
    "edition" => "6795595",
]);


$xml = simplexml_load_string($results->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);

echo "<pre>";
echo htmlentities($xml->asXML());
echo "</pre>";