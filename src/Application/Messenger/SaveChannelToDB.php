<?php
declare(strict_types=1);

namespace App\Application\Messenger;

use App\Domain\Entity\Channel;

class SaveChannelToDB
{
    private Channel $channel;

    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function getChannel(): Channel
    {
        return $this->channel;
    }

}