<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use App\Application\Validator\DateTimeValidator;

class Video
{
    private int $id;
    private string $externalId;
    private string $title;
    private string $description;
    private string $publishedAt;
    private string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        string $externalId,
        string $title,
        string $publishedAt,
        string $description,
        string $createdAt,
        ?string $updatedAt = null
    ){
        $this->externalId = $externalId;
        $this->title = $title;
        $this->publishedAt = $publishedAt;
        $this->description = $description;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
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