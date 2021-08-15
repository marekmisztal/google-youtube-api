<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Video;

interface VideoRepository
{
    public function create(Video $video);
}