<?php
declare(strict_types=1);

namespace App\Application\Validator;

use App\Application\Exception\ValidatorException;

class VideoIdValidator
{
    public static function validate(?string $videoId): void
    {
        if (is_null($videoId) or trim($videoId) == '') {
            throw new ValidatorException('Invalid videoId');
        }
    }
}