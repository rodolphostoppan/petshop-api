<?php

namespace src;

class HandleErrors
{
    private array $errors;

    public function setError(string $field, string $message)
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
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

    public function clearErrors(): array
    {
        return $this->errors = [];
    }
}
