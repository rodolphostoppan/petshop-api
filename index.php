<?php


require 'src/Controller.php';
require 'send-email.php';
require 'ValidateInputs.php';

header('Content-Type: application/json; charset=utf-8');

$database = new PDO('sqlite:petshop.db', '', '');
$validateInputs = new ValidateInputs();

$name = $email = $phone = "";
$message = "Estaremos entrando em contato por ligação ou enviando uma mensagem no WhatsApp";


use src\Controller;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$controller = new Controller($requestMethod);

$controller->processRequest();

exit();


function sendDataFormToDb( $database, $name, $email, $phone )
{
    $sql = "INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $database->prepare($sql);
    $stmt->execute([
        $name,
        $email,
        $phone
    ]);
    // $prepare = $database->prepare('INSERT INTO clients (name, email, phone) VALUES (?, ?, ?)');

    // $prepare->execute([
    //     'name' => $name,
    //     'email' => $email,
    //     'phone' => $phone
    // ]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $name = $validateInputs->validation($_POST['name']);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors["name"] = "Apenas letras e espaços são permitidos";
    }

    $email = $validateInputs->validation($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Formato de e-mail inválido";
    }

    $phone = $validateInputs->validation($_POST['phone']);
    if (strlen($phone) < 11) {
        $errors["phone"] = "Insira seu número de telefone completo";
    }

    if (empty($errors)) {
        sendDataFormToDb($database, $name, $email, $phone);
        sendEmail($email, $name, $message);
        echo json_encode(["success" => true, "errors" => $errors]);
    } else {
        echo json_encode(["success" => false, "errors" => $errors]);
    }
}
