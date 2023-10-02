<?php

require './index.php';

function showDataOfDb($database)
{
    $query = $database->query('SELECT * FROM clients');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    header('Content-Type: application/json');

    echo $json;
}

showDataOfDb($database);
