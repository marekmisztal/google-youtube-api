<?php
declare(strict_types=1);

namespace App\Application\Messenger;

use App\Domain\Repository\VideoRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SaveVideoToDBHandler implements MessageHandlerInterface
{
    private VideoRepository $videoRepository;

    public function __construct(
        VideoRepository $videoRepository
    ) {
        $this->videoRepository = $videoRepository;
    }

    public function __invoke(SaveVideoToDB $message)
    {
        if (!$this->videoRepository->alreadyExists($message->getVideo()->getExternalId())) {
            $this->videoRepository->create($message->getVideo());
        }
    }
}
