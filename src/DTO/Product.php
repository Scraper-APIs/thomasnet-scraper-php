<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Product
{
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $imageUrl,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            imageUrl: $data['imageUrl'] ?? null,
        );
    }
}
