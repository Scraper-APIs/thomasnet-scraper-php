<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Whitepaper
{
    public function __construct(
        public string $title,
        public ?string $shortDescription,
        public ?string $smallThumbnail,
        public ?string $docUrl,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            shortDescription: $data['shortDescription'] ?? null,
            smallThumbnail: $data['smallThumbnail'] ?? null,
            docUrl: $data['docUrl'] ?? null,
        );
    }
}
