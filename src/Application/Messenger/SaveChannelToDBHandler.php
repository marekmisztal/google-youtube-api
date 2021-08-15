<?php
declare(strict_types=1);

namespace App\Application\Messenger;

use App\Domain\Repository\ChannelRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SaveChannelToDBHandler implements MessageHandlerInterface
{
    private ChannelRepository $channelRepository;

    public function __construct(
        ChannelRepository $channelRepository
    ) {
        $this->channelRepository = $channelRepository;
    }

    public function __invoke(SaveChannelToDB $message)
    {
        if (!$this->channelRepository->alreadyExists($message->getChannel()->getExternalId())) {
            $this->channelRepository->create($message->getChannel());
        }
    }
}
