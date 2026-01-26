# [ThomasNet PHP Scraper](https://github.com/Scraper-APIs/thomasnet-scraper-php)

[![Tests](https://github.com/Scraper-APIs/thomasnet-scraper-php/actions/workflows/tests.yml/badge.svg)](https://github.com/Scraper-APIs/thomasnet-scraper-php/actions/workflows/tests.yml)
[![PHP Version](https://img.shields.io/badge/php-8.3%2B-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

A PHP library for fetching supplier data from the [ThomasNet Suppliers](https://thomasnet.com) Database using the [Apify ThomasNet Supplier actor](https://apify.com/zen-studio/thomasnet-suppliers-scraper). Returns fully typed DTOs for easy integration into your application.

## Installation

```bash
composer require scraper-apis/thomasnet-scraper
```

## Requirements

- PHP 8.3+
- Apify API token ([get one here](https://console.apify.com/account/integrations))

## Quick Start

```php
use ThomasNetScraper\Client;
use ThomasNetScraper\SearchMode;

$client = new Client('YOUR_APIFY_TOKEN');

// Search for valve manufacturers
$suppliers = $client->search('valve manufacturer');

foreach ($suppliers as $supplier) {
    echo $supplier->name . ' - ' . $supplier->primaryPhone . PHP_EOL;
}
```

## Usage

### Search by Product Category

```php
$suppliers = $client->search('CNC machining', SearchMode::All);
```

### Search by Company Name

```php
$suppliers = $client->search('Siemens', SearchMode::Name, maxResults: 50);
```

### Regional Search

```php
use ThomasNetScraper\Area;

$suppliers = $client->search(
    query: 'precision machining',
    mode: SearchMode::All,
    area: Area::Michigan,
    maxResults: 500
);
```

### Working with Supplier Data

```php
foreach ($suppliers as $supplier) {
    // Company info
    echo $supplier->name;
    echo $supplier->description;
    echo $supplier->yearFounded;
    echo $supplier->annualSales;        // e.g., "$250 Mil. and over"
    echo $supplier->numberEmployees;    // e.g., "1000+"

    // Contact
    echo $supplier->primaryPhone;
    echo $supplier->website;

    // Location
    echo $supplier->address->city;
    echo $supplier->address->state;
    echo $supplier->address->latitude;
    echo $supplier->address->longitude;

    // Certifications
    foreach ($supplier->certifications as $cert) {
        echo $cert->title;  // e.g., "ISO 9001:2015"
        echo $cert->type;   // e.g., "QUALITY"
        echo $cert->scope;
    }

    // Products
    foreach ($supplier->products as $product) {
        echo $product->name;
        echo $product->description;
    }

    // Personnel
    foreach ($supplier->personnel as $person) {
        echo $person->name;
        echo $person->title;
    }
}
```

### Filtering Results

```php
// Filter for ISO 9001 certified suppliers
$iso9001Suppliers = array_filter(
    $suppliers,
    fn($s) => $s->hasCertification('ISO 9001')
);

// Filter by state
$texasSuppliers = array_filter(
    $suppliers,
    fn($s) => $s->address->state === 'TX'
);

// Filter by employee count
$largeSuppliers = array_filter(
    $suppliers,
    fn($s) => $s->numberEmployees === '1000+'
);
```

## DTOs

### Supplier

| Property | Type | Description |
|----------|------|-------------|
| `tgramsId` | string | Unique identifier |
| `name` | string | Company name |
| `description` | ?string | Company description |
| `type` | ?string | Supplier type |
| `tier` | ?string | ThomasNet tier |
| `yearFounded` | ?int | Year established |
| `annualSales` | ?string | Revenue range |
| `numberEmployees` | ?string | Employee count range |
| `primaryPhone` | ?string | Main phone number |
| `website` | ?string | Company website |
| `logoUrl` | ?string | Logo image URL |
| `address` | Address | Location details |
| `certifications` | Certification[] | Quality certifications |
| `products` | Product[] | Product catalog |
| `headings` | Heading[] | ThomasNet category headings |
| `personnel` | Person[] | Company contacts |
| `brands` | Brand[] | Brand names |
| `social` | SocialLink[] | Social media links |
| `videos` | Video[] | Company videos |
| `news` | NewsArticle[] | Press releases |
| `whitepapers` | Whitepaper[] | Technical documents |
| `isMultiLocation` | bool | Has multiple locations |
| `xometryVerified` | bool | Xometry verification status |
| `isClaimed` | bool | Profile claimed by company |
| `scrapedAt` | DateTimeImmutable | Data extraction timestamp |

### Address

| Property | Type |
|----------|------|
| `address1` | ?string |
| `address2` | ?string |
| `city` | ?string |
| `state` | ?string |
| `stateName` | ?string |
| `zip` | ?string |
| `country` | ?string |
| `latitude` | ?float |
| `longitude` | ?float |

### Certification

| Property | Type |
|----------|------|
| `id` | int |
| `code` | string |
| `title` | string |
| `type` | string |
| `group` | ?string |
| `scope` | ?string |
| `imageUrl` | ?string |
| `url` | ?string |
| `date` | ?string |

## Area Codes

| Code | Region |
|------|--------|
| `NA` | All (North America) |
| `NT` | Texas North |
| `GT` | Texas South |
| `CN` | California North |
| `CS` | California South |
| `DN` | New York Metro |
| `UN` | New York Upstate |
| `IL` | Illinois |
| `MI` | Michigan |
| `NO` | Ohio North |
| `SO` | Ohio South |
| `EP` | Pennsylvania East |
| `WP` | Pennsylvania West |
| `ON` | Ontario |
| `QC` | Quebec |

See `Area` enum for the complete list of 50+ regions.

## Error Handling

```php
use ThomasNetScraper\Exception\ApiException;
use ThomasNetScraper\Exception\RateLimitException;
use ThomasNetScraper\Exception\InvalidQueryException;

try {
    $suppliers = $client->search('valve');
} catch (RateLimitException $e) {
    // Handle rate limiting
    sleep($e->retryAfter);
} catch (ApiException $e) {
    // Handle API errors
    echo $e->getMessage();
}
```

## Deduplication

When running multiple queries, use `tgramsId` as the unique key:

```php
$allSuppliers = [];

foreach (['valve', 'pump', 'fitting'] as $query) {
    foreach ($client->search($query) as $supplier) {
        $allSuppliers[$supplier->tgramsId] = $supplier;
    }
}

// $allSuppliers now contains unique suppliers only
```

## License

MIT
