<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class SocialLink
{
    public function __construct(
        public string $type,
        public string $url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'],
            url: $data['url'],
        );
    }
}
