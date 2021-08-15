<?php
declare(strict_types=1);

namespace App\Application\Messenger;

use App\Domain\Entity\Video;

class SaveVideoToDB
{
    private Video $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }
}