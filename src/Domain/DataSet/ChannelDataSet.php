<?php
declare(strict_types=1);

namespace App\Domain\DataSet;

class ChannelDataSet implements DataSet
{
    private string $id;
    private string $title;

    public function __construct(
        string $id,
        string $title
    ){
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function asArray()
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title
        ];
    }
}
