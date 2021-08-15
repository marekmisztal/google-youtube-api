<?php
declare(strict_types=1);

namespace App\Infrastructure\Api;

use App\Domain\Api\ApiService;
use Google\Client;
use Google\Service\YouTube;

class YoutubeApiService implements ApiService
{
    protected string $apiKey;

    public function __construct(
        string $apiKey
    ){
        $this->apiKey = $apiKey;
    }

    public function getService(): YouTube
    {
        $client = new Client();
        $client->setApplicationName("Google Youtube API");
        $client->setDeveloperKey($this->apiKey);

        return new YouTube($client);
    }
}