<?php
declare(strict_types=1);

namespace App\Domain\Api;

use Google\Service\YouTube;

interface ApiService
{
    public function getService(): YouTube;
}