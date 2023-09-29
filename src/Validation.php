<?php

namespace src;

use Exception;

require 'HandleErrors.php';

class Validation
{
    private Sanitization $sanitization;
    private HandleErrors $handleErrors;

    public function __construct()
    {
        $this->sanitization = new Sanitization();
        $this->handleErrors = new HandleErrors();
    }

    public function validateInputs(string $name, string $email, string $phone): array
    {
        $validatedName = $this->validateName($name);
        $validatedEmail = $this->validateEmail($email);
        $validatedPhone = $this->validatePhone($phone);
        $response = [
            'name' => $validatedName,
            'email' => $validatedEmail,
            'phone' => $validatedPhone
        ];

        if ($this->handleErrors->hasError()) {
            $errorsMessages = json_encode(['fields' => $this->handleErrors->getError()]);
            throw new Exception($errorsMessages, 400);
        }
        $this->handleErrors->clearErrors();
        return $response;
    }

    private function validateName(string $name): string
    {
        $sanitizedName = $this->sanitization->sanitizeInputs($name);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $sanitizedName)) {
            $this->handleErrors->setError('name', 'O campo deve conter apenas letras e espaços.');
        }
        return $sanitizedName;
    }

    private function validateEmail(string $email): string
    {
        $sanitizedEmail = $this->sanitization->sanitizeInputs($email);
        if (!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            $this->handleErrors->setError('email', 'O campo de e-mail deve ser válido.');
        }
        return $sanitizedEmail;
    }

    private function validatePhone(string $phone): string
    {
        $sanitizedPhone = $this->sanitization->sanitizeInputs($phone);
        if (strlen($sanitizedPhone) < 15) {
            $this->handleErrors->setError('phone', 'Insira seu número de telefone completo.');
        }
        return $sanitizedPhone;
    }
}
