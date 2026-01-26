<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Certification
{
    public function __construct(
        public int $id,
        public string $code,
        public string $title,
        public string $type,
        public ?string $tier,
        public ?string $group,
        public ?string $scope,
        public ?string $imageUrl,
        public ?string $thumbnailUrl,
        public ?string $url,
        public ?string $date,
        public bool $isActive,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            code: $data['code'],
            title: $data['title'],
            type: $data['type'],
            tier: $data['tier'] ?? null,
            group: $data['group'] ?? null,
            scope: $data['scope'] ?? null,
            imageUrl: $data['imageUrl'] ?? null,
            thumbnailUrl: $data['thumbnailUrl'] ?? null,
            url: $data['url'] ?? null,
            date: $data['date'] ?? null,
            isActive: $data['isActive'] ?? false,
        );
    }
}
