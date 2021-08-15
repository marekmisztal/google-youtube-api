<?php
declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Domain\Controller\RestApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseRestApiController implements RestApiController
{
    protected string $apiToken;

    public function __construct(string $apiToken) {
        $this->apiToken = $apiToken;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    protected function getSuccessJsonResponse($result, $statusCode = 200)
    {
        return new JsonResponse(
            [
                'status'        => 'success',
                'result'        => $result
            ],
            $statusCode
        );
    }
}
