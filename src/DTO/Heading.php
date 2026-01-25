<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Heading
{
    public function __construct(
        public string $headingId,
        public string $name,
        public ?string $familyName,
        public ?string $description,
        public ?string $url,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            headingId: (string) $data['headingId'],
            name: $data['name'],
            familyName: $data['familyName'] ?? null,
            description: $data['description'] ?? null,
            url: $data['url'] ?? null,
        );
    }
}
