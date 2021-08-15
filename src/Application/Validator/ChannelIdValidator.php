<?php
declare(strict_types=1);

namespace App\Application\Validator;

use App\Application\Exception\ValidatorException;

class ChannelIdValidator
{
    public static function validate(?string $channelId): void
    {
        if (is_null($channelId) or trim($channelId) == '') {
            throw new ValidatorException('Invalid channelId');
        }
    }
}