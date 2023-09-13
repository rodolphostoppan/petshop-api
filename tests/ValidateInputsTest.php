<?php

use PHPUnit\Framework\TestCase;

require 'ValidateInputs.php';

class ValidateInputsTest extends TestCase
{
    public function testValidationRemovesWhitespace()
    {
        $validator = new ValidateInputs();
        $input = ' Rodolpho Toppan  ';
        $expected = 'Rodolpho Toppan';

        $result = $validator->validation($input);

        self::assertEquals($expected, $result);
    }

    public function testValidationRemoveSlashes()
    {
        $validator = new ValidateInputs();
        $input = '\teste.rod\@email.com';
        $expected = 'teste.rod@email.com';

        $result = $validator->validation($input);

        self::assertEquals($expected, $result);
    }

    public function testValidationHTMLSpecialChars()
    {
        $validator = new ValidateInputs();
        $input = "<script>alert('Eu sou um script malicioso!')</script>";
        $expected = '&lt;script&gt;alert(&#039;Eu sou um script malicioso!&#039;)&lt;/script&gt;';

        $result = $validator->validation($input);

        self::assertEquals($expected, $result);
    }

    public function testValidationRemovesWhitespaceBetweenWords()
    {
        $validator = new ValidateInputs();
        $input = "   (17)   9  1234-1234    ";
        $expected = "(17) 9 1234-1234";

        $result = $validator->validation($input);

        self::assertEquals($expected, $result);
    }
}
