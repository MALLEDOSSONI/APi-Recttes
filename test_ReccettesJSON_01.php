<?php
$url = 'http://localhost/API%20RECETTE/recettes-api/recettes.php/recettes'; // PATH_INFO important ici !
$jsonFile = 'recettes.json';

if (!file_exists($jsonFile)) {
    die("Le fichier JSON n'existe pas.");
}

$recettes = json_decode(file_get_contents($jsonFile), true);

foreach ($recettes as $recette) {
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($recette),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo "Erreur lors de l'envoi : " . $recette['nom'] . "\n";
    } else {
        echo "Succès : " . $recette['nom'] . " → " . $result . "\n";
    }
}
