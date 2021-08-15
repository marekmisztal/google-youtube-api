<?php
declare(strict_types=1);

namespace App\Application\Validator\RestApi;

use App\Application\Exception\RestApiException;
use App\Domain\DataSet\ChannelDataSet;

class ChannelValidator
{
    public static function validate(?ChannelDataSet $channelDataSet): void
    {
        if (is_null($channelDataSet)) {
            throw new RestApiException('Channel does not exist!', 400);
        }
    }
}