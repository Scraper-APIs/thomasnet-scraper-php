<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class CertificationTotal
{
    public function __construct(
        public string $type,
        public int $count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'],
            count: (int) $data['count'],
        );
    }
}
