<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

final readonly class Address
{
    public function __construct(
        public ?string $address1,
        public ?string $address2,
        public ?string $city,
        public ?string $state,
        public ?string $stateName,
        public ?string $zip,
        public ?string $country,
        public ?float $latitude,
        public ?float $longitude,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            address1: $data['address1'] ?? null,
            address2: $data['address2'] ?? null,
            city: $data['city'] ?? null,
            state: $data['state'] ?? null,
            stateName: $data['stateName'] ?? null,
            zip: $data['zip'] ?? null,
            country: $data['country'] ?? null,
            latitude: isset($data['latitude']) ? (float) $data['latitude'] : null,
            longitude: isset($data['longitude']) ? (float) $data['longitude'] : null,
        );
    }
}
