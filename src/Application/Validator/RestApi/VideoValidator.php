<?php
declare(strict_types=1);

namespace App\Application\Validator\RestApi;

use App\Application\Exception\RestApiException;
use App\Domain\DataSet\VideoDataSet;

class VideoValidator
{
    public static function validate(?VideoDataSet $videoDataSet): void
    {
        if (is_null($videoDataSet)) {
            throw new RestApiException('Video does not exist!', 400);
        }
    }
}