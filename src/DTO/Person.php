<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Person
{
    public function __construct(
        public string $name,
        public ?string $title,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            title: $data['title'] ?? null,
        );
    }
}
