<?php
declare(strict_types=1);

namespace App\Domain\DataSet;

class VideoDataSet implements DataSet
{
    private string $id;
    private string $title;
    private string $publishedAt;
    private string $description;

    public function __construct(
        string $id,
        string $title,
        string $publishedAt,
        string $description
    ){
        $this->id = $id;
        $this->title = $title;
        $this->publishedAt =
            substr($publishedAt, 0, 10) . ' ' . substr($publishedAt, 11, 8);
        $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function asArray()
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'publishedAt'   => $this->publishedAt,
            'description'   => $this->description
        ];
    }
}
