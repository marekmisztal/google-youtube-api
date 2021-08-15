<?php
declare(strict_types=1);

namespace App\UI\Http\Rest\Controller;

use App\Application\Exception\RestApiException;
use App\Application\Validator\RestApi\ChannelValidator;
use App\Application\Validator\RestApi\VideoValidator;
use App\Domain\Api\ApiService;
use App\Domain\DataSet\ChannelDataSet;
use App\Domain\DataSet\VideoDataSet;
use App\Infrastructure\Api\Channels\ChannelsListByIdProvider;
use App\Infrastructure\Api\Channels\ChannelsListByUsernameProvider;
use App\Infrastructure\Api\Videos\VideosListByIdProvider;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class YoutubeRestApiController extends BaseRestApiController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function apiIndex()
    {
        return $this->getSuccessJsonResponse('api OK');
    }

    /**
     * @Route("/channels/byid/{channelId}", name="channelsByIdList", methods={"GET"})
     */
    public function channelsByIdList(
        ApiService $service,
        string $channelId
    ){
        $provider = new ChannelsListByIdProvider($service, $channelId);

        /* @var $channelDataSet ChannelDataSet */
        $channelDataSet = $provider->provide();
        ChannelValidator::validate($channelDataSet);

        return $this->getSuccessJsonResponse(
            $channelDataSet->asArray()
        );
    }

    /**
     * @Route("/channels/byusername/{username}", name="channelsByUsernameList", methods={"GET"})
     */
    public function channelsByUsernameList(
        ApiService $service,
        string $username
    ){
        $provider = new ChannelsListByUsernameProvider($service, $username);

        /* @var $channelDataSet ChannelDataSet */
        $channelDataSet = $provider->provide();
        ChannelValidator::validate($channelDataSet);

        return $this->getSuccessJsonResponse(
            $channelDataSet->asArray()
        );
    }

    /**
     * @Route("/videos/byid/{videoId}", name="videosByIdList", methods={"GET"})
     */
    public function videosByIdList(
        ApiService $service,
        string $videoId
    ){
        $provider = new VideosListByIdProvider($service, $videoId);

        /* @var $videoDataSet VideoDataSet */
        $videoDataSet = $provider->provide();
        VideoValidator::validate($videoDataSet);

        return $this->getSuccessJsonResponse(
            $videoDataSet->asArray()
        );
    }
}
