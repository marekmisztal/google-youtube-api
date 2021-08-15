<?php
declare(strict_types=1);

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="channel",
 *     indexes={
 *          @ORM\Index(name="idx_channel_externalId", columns={"externalId"})
 *     }
 * )
 */
class DoctrineChannel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="externalId", type="string", length=32)
     */
    private string $externalId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $title;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private string $createdAt;

    /**
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private string $updatedAt;
}
