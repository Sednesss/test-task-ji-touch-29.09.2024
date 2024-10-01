<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected array $args;
    protected string $messageCode = 'UNKNOWN_ERROR';

    public function __construct(string $message = '', array $args = [], string $messageCode = '')
    {
        if (empty($message)) {
            $message = 'Unknown error';
        }

        $this->args = $args;
        $this->messageCode = $messageCode;

        parent::__construct($message);
    }

    public function getMessageCode(): string
    {
        return $this->messageCode;
    }
}
