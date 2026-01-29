<?php

require __DIR__ . '/vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:30001");
$collection = $client->test->adherent;

$json = file_get_contents('./test.json');
$data = json_decode($json, true);

$result = $collection->insertOne($data);