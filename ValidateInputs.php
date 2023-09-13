<?php

class ValidateInputs
{
    public $data;

    public function validation($data)
    {
        $data = trim($data);
        $data = preg_replace('/\s+/', ' ', $data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
