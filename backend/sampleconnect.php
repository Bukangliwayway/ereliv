<?php
require '../vendor/autoload.php';

// Replace 'localhost' with your server's IP or hostname if necessary
$hosts = ['localhost:9200'];

$client = Elasticsearch\ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

// Check if the connection is successful
if ($client->ping()) {
    echo "Connected to Elasticsearch.";
} else {
    echo "Connection failed.";
}