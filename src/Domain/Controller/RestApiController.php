<?php
declare(strict_types=1);

namespace App\Domain\Controller;

interface RestApiController
{
    public function getApiToken(): string;
}