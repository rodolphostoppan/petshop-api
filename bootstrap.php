<?php

use PHPMailer\PHPMailer\PHPMailer;
use Src\Controller;
use Src\HandleErrors;
use Src\Sanitization;
use Src\SendEmailService;
use Src\Validation;


require './vendor/autoload.php';
require 'src/Controller.php';
require 'src/HandleErrors.php';
require 'src/Sanitization.php';
require 'src/SendEmailService.php';
require 'src/Validation.php';

$controller = new Controller();
$handleErrors = new HandleErrors();
$sanitization = new Sanitization();
$sendEmailService = new SendEmailService();
$validation = new Validation($sanitization);
$mail = new PHPMailer();
