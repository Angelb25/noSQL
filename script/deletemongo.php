<?php

require __DIR__ . '/../vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:30001");
$collection = $client->test->adherent;

$collection->drop();