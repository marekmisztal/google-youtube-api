<?php
declare(strict_types=1);

namespace App\Infrastructure\Api\Channels;

use App\Domain\Api\ApiService;
use App\Domain\Api\Provider;
use App\Domain\DataSet\ChannelDataSet;

/*
 * https://developers.google.com/youtube/v3/docs/channels/list
 * by YouTube username
 */
class ChannelsListByUsernameProvider implements Provider
{
    private ApiService $apiService;
    private string $username;

    public function __construct(ApiService $apiService, string $username)
    {
        $this->apiService = $apiService;
        $this->username = $username;
    }

    public function provide(): ?ChannelDataSet
    {
        $youtubeService = $this->apiService->getService();

        $part = [
            'snippet'
        ];
        $optParams = [
            'forUsername' => $this->username
        ];
        /* @var $result \Google\Service\YouTube\ChannelListResponse */
        $results = $youtubeService->channels->listChannels($part, $optParams);

        /* @var $result \Google\Service\YouTube\Channel */
        foreach ($results as $result) {
            return new ChannelDataSet(
                $result->getId(),
                $result->getSnippet()->getTitle()
            );
        }
        return null;
    }
}