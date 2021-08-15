<?php
declare(strict_types=1);

namespace App\UI\Cli\Command;

use App\Application\Messenger\SaveVideoToDB;
use App\Application\Validator\RestApi\VideoValidator;
use App\Application\Validator\VideoIdValidator;
use App\Domain\Api\ApiService;
use App\Domain\DataSet\VideoDataSet;
use App\Domain\Entity\Video;
use App\Infrastructure\Api\Videos\VideosListByIdProvider;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;

class GetVideoByIdCommand extends BaseCommand
{
    protected static $defaultName = 'video:byid:get';
    private ApiService $apiService;
    private MessageBusInterface $messageBus;

    public function __construct(
        string $name = null,
        ApiService $apiService,
        MessageBusInterface $messageBus
    ) {
        parent::__construct($name);
        $this->apiService = $apiService;
        $this->messageBus = $messageBus;
    }

    protected function config()
    {
        $this
            ->setDescription('Youtube API: get video by ID')
            ->addArgument('videoId', InputArgument::REQUIRED, '')
            ->addOption('saveToDB', null, InputOption::VALUE_NONE)
        ;
    }

    protected function exec()
    {
        $videoId = $this->input->getArgument('videoId');
        VideoIdValidator::validate($videoId);

        $provider = new VideosListByIdProvider($this->apiService, $videoId);

        /* @var $videoDataSet VideoDataSet */
        $videoDataSet = $provider->provide();
        VideoValidator::validate($videoDataSet);

        var_dump($videoDataSet->asArray());

        if ($this->input->getOption('saveToDB')) {
            $this->messageBus->dispatch(
                new SaveVideoToDB(
                    new Video(
                        $videoDataSet->getId(),
                        $videoDataSet->getTitle(),
                        $videoDataSet->getPublishedAt(),
                        $videoDataSet->getDescription(),
                        date('Y-m-d H:i:s')
                    )
                )
            );
        }

        return BaseCommand::SUCCESS;
    }
}