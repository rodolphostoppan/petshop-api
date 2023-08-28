<?php

require 'send-email.php';

header("Access-Control-Allow-Origin: *"); // Allow requests from any domain
header("Content-Type: application/json; charset=UTF-8");

$database = new PDO('sqlite:petshop.db', '', '');

$name = $email = $phone = "";
$message = "Estaremos entrando em contato por ligação ou enviando uma mensagem no WhatsApp";

function validateInputs($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function sendDataFormToDb($database, $name, $email, $phone)
{
    $prepare = $database->prepare('INSERT INTO clients (name, email, phone) VALUES (:name, :email, :phone)');

    $prepare->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    ]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $errors = [];

    $name = validateInputs($_POST['name']);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errors["name"] = "Apenas letras e espaços são permitidos";
    }

    $email = validateInputs($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Formato de e-mail inválido";
    }

    $phone = validateInputs($_POST['phone']);
    if (strlen($phone) < 11) {
        $errors["phone"] = "Insira seu número de telefone completo";
    }

    if (empty($errors)) {
        sendDataFormToDb($database, $name, $email, $phone);
        sendEmail($email, $name, $message);
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "errors" => $errors]);
    }
}
