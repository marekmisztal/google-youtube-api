<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use App\Application\Validator\DateTimeValidator;

class Channel
{
    private int $id;
    private string $externalId;
    private string $title;
    private string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        string $externalId,
        string $title,
        string $createdAt,
        ?string $updatedAt = null
    ){
        $this->externalId = $externalId;
        $this->title = $title;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        DateTimeValidator::validate($createdAt);
        if (!is_null($updatedAt)) {
            DateTimeValidator::validate($updatedAt);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}