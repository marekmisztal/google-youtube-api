<?php
declare(strict_types=1);

namespace App\UI\Cli\Command;

use App\Application\Messenger\SaveChannelToDB;
use App\Application\Validator\ChannelIdValidator;
use App\Application\Validator\RestApi\ChannelValidator;
use App\Domain\Api\ApiService;
use App\Domain\DataSet\ChannelDataSet;
use App\Domain\Entity\Channel;
use App\Infrastructure\Api\Channels\ChannelsListByIdProvider;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Messenger\MessageBusInterface;

class GetChannelByIdCommand extends BaseCommand
{
    protected static $defaultName = 'channel:byid:get';
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
            ->setDescription('Youtube API: get channel by ID')
            ->addArgument('channelId', InputArgument::REQUIRED, '')
            ->addOption('saveToDB', null, InputOption::VALUE_NONE)
        ;
    }

    protected function exec()
    {
        $channelId = $this->input->getArgument('channelId');
        ChannelIdValidator::validate($channelId);

        $provider = new ChannelsListByIdProvider($this->apiService, $channelId);

        /* @var $channelDataSet ChannelDataSet */
        $channelDataSet = $provider->provide();
        ChannelValidator::validate($channelDataSet);

        var_dump($channelDataSet->asArray());

        if ($this->input->getOption('saveToDB')) {
            $this->messageBus->dispatch(
                new SaveChannelToDB(
                    new Channel(
                        $channelDataSet->getId(),
                        $channelDataSet->getTitle(),
                        date('Y-m-d H:i:s')
                    )
                )
            );
        }

        return BaseCommand::SUCCESS;
    }
}