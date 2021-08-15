<?php
declare(strict_types=1);

namespace App\Application\Validator;

use App\Application\Exception\ValidatorException;

class DateValidator
{
    public static function validate(string $date, string $format = 'Y-m-d'): void
    {
        $d = \DateTime::createFromFormat($format, $date);
        if (!($d && $d->format($format) === $date)) {
            throw new ValidatorException('Invalid date '.$date);
        }
    }
}