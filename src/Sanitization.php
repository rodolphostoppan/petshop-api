<?php

namespace src;
class Sanitization
{
    public function sanitizeInputs(string $input): string
    {
        $sanitizedInput = $this->removeWhitespaceAroundWords($input);
        $sanitizedInput = $this->removeWhitespaceBetweenWords($sanitizedInput);
        $sanitizedInput = $this->removeBackslashes($sanitizedInput);
        $sanitizedInput = $this->convertSpecialCharactersToHtmlEntities($sanitizedInput);

        return $sanitizedInput;
    }

    private function removeWhitespaceAroundWords(string $input): string
    {
        return trim($input);
    }

    private function removeWhitespaceBetweenWords(string $input): string
    {
        return preg_replace('/\s+/', ' ', $input);
    }

    private function removeBackslashes(string $input): string
    {
        return stripslashes($input);
    }

    private function convertSpecialCharactersToHtmlEntities(string $input): string
    {
        return htmlentities($input);
    }
}
