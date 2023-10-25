<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("../racine.php");
    include_once RACINE . '/service/PositionService.php';
    create();
}

function create() {
    // Récupérer les données JSON de la requête
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data);

    // Vérifier si les données JSON ont été correctement décodées
    if ($data === null) {
        http_response_code(400);
        echo json_encode(array("message" => "Données JSON invalides"));
        return;
    }

    extract((array) $data); // Vous pouvez extraire les données ici si nécessaire

    $ps = new PositionService();

    // Créer un objet Position en utilisant les données JSON
    $position = new Position(1, $data->latitude, $data->longitude, $data->date, $data->imei);

    // Appeler la méthode create avec l'objet Position
    $ps->create($position);

    header('Content-type: application/json');
    echo json_encode($ps->findAllApi());
}
