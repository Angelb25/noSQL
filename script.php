<?php

use MongoDB\Client;

include "config.php";
include "traitement.php";

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die("Erreur connexion : " . $e->getMessage());
}

insert_sortie($pdo, "test");

function insert_sortie($pdo, $nom_club) {

    $sql = "SELECT s.idsortie, s.nom, s.lieu, s.datedebut, :club AS club
            FROM sortie s
            LIMIT 10";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':club' => $nom_club
    ]);

    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');

    foreach ($resultats as $ligne) {

        echo json_encode($ligne);
    } 
}

require __DIR__ . '\vendor\autoload.php';



try {
    $client = new Client("mongodb://localhost:30001");
    $db = $client->test;


    echo "Connexion MongoDB réussie";
} catch (Exception $e) {
    echo "Erreur MongoDB : " . $e->getMessage();
}