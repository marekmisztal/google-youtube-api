<?php
declare(strict_types=1);

namespace App\Application\Validator;

class DateTimeValidator
{
    public static function validate(string $date): void
    {
        DateValidator::validate($date, 'Y-m-d H:i:s');
    }
}