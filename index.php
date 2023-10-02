<?php

use src\Controller;

require 'src/Controller.php';

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] != 'send-email' || count($uri) > 2 || $_SERVER["REQUEST_METHOD"] !== 'POST') {
    header(http_response_code(404));
    exit;
}

$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new Controller($requestMethod);

try {
    $controller->processRequest();
} catch (Exception $exception) {
    $errorMessages = json_decode($exception->getMessage(), true);
    $response = [
        'success' => false,
        'message' => 'Verifique os campos novamente',
        'errors' => $errorMessages
    ];
    header("Access-Control-Allow-Origin: *", http_response_code($exception->getCode()));
    echo json_encode($response);
}

//$database = new PDO('sqlite:petshop.db', '', '');

//function sendDataFormToDb( $database, $name, $email, $phone )
//{
//    $sql = "INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)";
//    $stmt = $database->prepare($sql);
//    $stmt->execute([
//        $name,
//        $email,
//        $phone
//    ]);
//    // $prepare = $database->prepare('INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)');
//
//    // $prepare->execute([
//    //     'name' => $name,
//    //     'email' => $email,
//    //     'phone' => $phone
//    // ]);
//}