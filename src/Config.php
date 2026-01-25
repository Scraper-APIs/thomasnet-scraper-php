<?php

declare(strict_types=1);

namespace ThomasNetScraper;

final readonly class Config
{
    public function __construct(
        public string $apiToken,
        public string $actorId = 'zen-studio/thomasnet-suppliers-scraper',
        public string $baseUrl = 'https://api.apify.com/v2',
        public int $timeout = 300,
    ) {}
}
