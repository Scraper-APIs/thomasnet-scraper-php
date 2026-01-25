<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class NewsArticle
{
    public function __construct(
        public string $id,
        public string $headline,
        public ?string $summary,
        public ?string $pubDate,
        public ?string $image,
        public ?string $type,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            headline: $data['headline'],
            summary: $data['summary'] ?? null,
            pubDate: $data['pubDate'] ?? null,
            image: $data['image'] ?? null,
            type: $data['type'] ?? null,
        );
    }
}
