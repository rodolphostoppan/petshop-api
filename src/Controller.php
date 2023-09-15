<?php


namespace src;
class Controller
{
    private $requestMethod;

    public function __construct( $requestMethod )
    {
        $this->requestMethod = $requestMethod;
    }

    public function processRequest(): void
    {
        switch ($this->requestMethod) {
            case 'GET':
                echo 'metodo GET';

                break;

            case 'POST':
                echo 'método POST';

                break;
        }
    }
}
