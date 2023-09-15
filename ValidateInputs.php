<?php

class ValidateInputs
{
    public $data;

    public function validation($input)
    {
        $this->data = trim($input);
        $this->data = preg_replace('/\s+/', ' ', $input);
        $this->data = stripslashes($input);
        $this->data = htmlspecialchars($input);
        $this->data = htmlentities($input);

        return $this->data;
    }
}
