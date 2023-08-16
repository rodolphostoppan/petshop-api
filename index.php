<?php
require 'send-email.php';

$database = new PDO('sqlite:petshop.db', '', '');

$errEmail = $errName = $errPhone = "";
$name = $email = $phone = "";
$message = "Vamos estar entrando em contato por ligação ou uma mensagem no WhatsApp";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = validateInputs($_POST['name']);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $errName = "Apenas letras e espaços são permitidos";
    }

    $email = validateInputs($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Formato de e-mail inválido";
    }

    $phone = validateInputs($_POST['phone']);
    if (strlen($phone) < 11) {
        $errPhone =  "Insira seu número de telefone completo";
    }

    sendDataFormToDb($database, $name, $email, $phone);
    sendEmail($email, $name, $message);
}

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



function showDataOfDb($database)
{
    $query = $database->query('SELECT * FROM clients');
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    header('Content-Type: application/json');
    echo $json;
}

showDataOfDb($database);
