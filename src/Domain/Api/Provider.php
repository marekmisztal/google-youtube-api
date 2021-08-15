<?php
declare(strict_types=1);

namespace App\Domain\Api;

use App\Domain\DataSet\DataSet;

interface Provider
{
    public function provide(): ?DataSet;
}