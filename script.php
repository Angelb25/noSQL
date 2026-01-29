<?php
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

$host = "localhost";
$port = "5432";
$dbname = "Asvel";
$user = "postgres";
$password = "Enzo.2508";

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
    
    $client = new Client("mongodb://localhost:30001");
    $collection = $client->test->adherent;

    foreach ($resultats as $ligne) {
        $collection->insertOne($ligne); 
    }

    try {
        
        $db = $client->test;

        echo "Connexion MongoDB réussie";
    } catch (Exception $e) {
        echo "Erreur MongoDB : " . $e->getMessage();
    }
}
