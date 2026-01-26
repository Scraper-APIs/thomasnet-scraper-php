<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Video
{
    public function __construct(
        public string $title,
        public ?string $url,
        public ?string $thumbnailUrl,
        public ?string $description,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            url: $data['url'] ?? null,
            thumbnailUrl: $data['thumbnailUrl'] ?? null,
            description: $data['description'] ?? null,
        );
    }
}
