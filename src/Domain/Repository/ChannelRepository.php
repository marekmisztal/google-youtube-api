<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Channel;

interface ChannelRepository
{
    public function create(Channel $channel);
}