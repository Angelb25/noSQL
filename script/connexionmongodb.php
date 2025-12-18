<?php

require __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

try {
    $client = new Client("mongodb://localhost:30001");
    $db = $client->test;


    echo "✅ Connexion MongoDB réussie";
} catch (Exception $e) {
    echo "❌ Erreur MongoDB : " . $e->getMessage();
}
