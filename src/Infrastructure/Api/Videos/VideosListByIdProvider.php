<?php
declare(strict_types=1);

namespace App\Infrastructure\Api\Videos;

use App\Domain\Api\ApiService;
use App\Domain\Api\Provider;
use App\Domain\DataSet\VideoDataSet;

/*
 * https://developers.google.com/youtube/v3/docs/videos/list
 * by channel ID
 */
class VideosListByIdProvider implements Provider
{
    private ApiService $apiService;
    private string $videoId;

    public function __construct(ApiService $apiService, string $videoId)
    {
        $this->apiService = $apiService;
        $this->videoId = $videoId;
    }

    public function provide(): ?VideoDataSet
    {
        $youtubeService = $this->apiService->getService();

        $part = [
            'snippet'
        ];
        $optParams = [
            'id' => $this->videoId
        ];
        /* @var $result \Google\Service\YouTube\VideoListResponse */
        $results = $youtubeService->videos->listVideos($part, $optParams);

        /* @var $result \Google\Service\YouTube\Video */
        foreach ($results as $result) {
            return new VideoDataSet(
                $result->getId(),
                $result->getSnippet()->getTitle(),
                $result->getSnippet()->getPublishedAt(),
                $result->getSnippet()->getDescription()
            );
        }
        return null;
    }
}