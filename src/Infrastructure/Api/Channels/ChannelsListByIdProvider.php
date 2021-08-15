<?php
declare(strict_types=1);

namespace App\Infrastructure\Api\Channels;

use App\Domain\Api\ApiService;
use App\Domain\Api\Provider;
use App\Domain\DataSet\ChannelDataSet;
use App\Infrastructure\Api\BaseProvider;

/*
 * https://developers.google.com/youtube/v3/docs/channels/list
 * by channel ID
 */
class ChannelsListByIdProvider implements Provider
{
    private ApiService $apiService;
    private string $channelId;

    public function __construct(ApiService $apiService, string $channelId)
    {
        $this->apiService = $apiService;
        $this->channelId = $channelId;
    }

    public function provide(): ?ChannelDataSet
    {
        $youtubeService = $this->apiService->getService();

        $part = [
            'snippet'
        ];
        $optParams = [
            'id' => $this->channelId
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