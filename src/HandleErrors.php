<?php

namespace src\HandleErrors;

class HandleErrors
{
    private array $errors = [];

    public function setError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function getError(): array
    {
        return $this->errors;
    }

    public function hasError(): bool
    {
        return !empty($this->errors);
    }

    public function clearErrors(): void
    {
        $this->errors = [];
    }
}
