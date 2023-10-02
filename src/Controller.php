<?php

namespace src\Controller;

use src\SendEmailService\SendEmailService;
use src\Validation\Validation;

class Controller
{
    private string $requestMethod;
    private SendEmailService $sendEmailService;
    private Validation $validation;

    public function __construct($requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->sendEmailService = new SendEmailService();
        $this->validation = new Validation();
    }

    public function processRequest(): void
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->sendEmail();
                break;

            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        echo json_encode($response);
    }

    private function sendEmail()
    {
        $validationIsTrue = $this->validateInputs();
        if ($validationIsTrue) {
            $this->sendEmailService->send($validationIsTrue['email'], $validationIsTrue['name']);
        }
        return [
            'success' => true,
            'status_code_header' => http_response_code(200),
            'body' => 'E-mail enviado com sucesso!'
        ];
    }

    private function validateInputs(): array
    {
        $validInputs = $this->validation->validateInputs($_POST['name'], $_POST['email'], $_POST['phone']);
        return $validInputs;
    }

    private function notFoundResponse(): array
    {
        $response = [
            'status_code_header' => http_response_code(404),
            'body' => null
        ];
        return $response;
    }
}