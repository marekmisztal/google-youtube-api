<?php
declare(strict_types=1);

namespace App\Application\Exception;

class BaseException extends \Exception
{
    public function __construct(string $message, int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public function getStatusCode(): int
    {
        return $this->getCode();
    }
}