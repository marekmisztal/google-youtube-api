<?php
declare(strict_types=1);

namespace App\UI\Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\{Input\InputInterface,Input\InputOption,Output\OutputInterface};

abstract class BaseCommand extends Command
{
    const SUCCESS = Command::SUCCESS;
    const FAILURE = Command::FAILURE;

    protected InputInterface $input;
    protected OutputInterface $output;

    abstract protected function exec();
    abstract protected function config();

    protected function configure()
    {
        $this->config();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->showInfo($this->getDescription(), 'info');
        $this->showInfo('=======================================', 'info');

        try {
            return $this->exec();
        } catch (\Exception $e) {
            $this->showInfo(
                $e->getMessage(),
                'error',
                OutputInterface::VERBOSITY_NORMAL
            );
            return self::FAILURE;
        }
    }

    public function getExecTime($startTime, $endTime = null)
    {
        $endTime = $endTime ?? time();
        $time = $endTime - $startTime;
        return sprintf(
            'TIME: %ds. MEMORY: %d MB',
            $time,
            round(memory_get_usage(true) / 1024 / 1024, 2)
        );
    }

    protected function showInfo(
        string $info,
        string $style = '',
        int $verbosity = OutputInterface::VERBOSITY_DEBUG,
        bool $newLine = true
    ) {
        switch ($style) {
            case 'info':
                $info = '<info>' . $info . '</info>';
                break;
            case 'comment':
                $info = '<comment>' . $info . '</comment>';
                break;
            case 'question':
                $info = '<question>' . $info . '</question>';
                break;
            case 'error':
                $info = '<error>' . $info . '</error>';
                break;
        }

        $this->output->write(
            $info,
            $newLine,
            $verbosity
        );
    }
}