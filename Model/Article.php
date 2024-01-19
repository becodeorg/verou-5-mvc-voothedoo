<?php

declare(strict_types=1);

class Article
{
    public int $id;
    public string $title;
    public string $description;
    public string $publishDate;
    public ?string $imageUrl;
    public ?string $important;

    public function __construct(int $id, string $title, ?string $description, ?string $publishDate, ?string $imageUrl = "", ?string $important = "")
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->imageUrl = $imageUrl;
        $this->important = $important;
    }

    public function formatPublishDate($format = 'd-m-Y')
    {
        if ($this->publishDate !== null) {
            $dateTime = new DateTime($this->publishDate);

            return $dateTime->format($format);
        }

        return '';
    }
}