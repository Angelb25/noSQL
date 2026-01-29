<?php
require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

$client = new Client("mongodb://localhost:30001");
// connect to mongodb
echo "Connection to database successfully";

// select a database
$db = $client->test;
echo "Database selected";

$collection = $db->createCollection("adherent");

echo "Collection created succsessfully";
?>