<?php

require __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;

//Connexion à MongoDB
$client = new Client("mongodb://localhost:30001");
$collection = $client->test->adherent;

echo $collection;
//Paramètres

//Affichage