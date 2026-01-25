<?php

declare(strict_types=1);

namespace ThomasNetScraper\DTO;

use DateTimeImmutable;

final readonly class Supplier
{
    /**
     * @param  Heading[]  $headings
     * @param  Certification[]  $certifications
     * @param  CertificationTotal[]  $certificationTotals
     * @param  Product[]  $products
     * @param  Person[]  $personnel
     * @param  Brand[]  $brands
     * @param  SocialLink[]  $social
     * @param  Video[]  $videos
     * @param  NewsArticle[]  $news
     * @param  Whitepaper[]  $whitepapers
     * @param  string[]  $otherActivities
     */
    public function __construct(
        public string $tgramsId,
        public string $name,
        public ?string $description,
        public ?string $type,
        public ?string $tier,
        public ?int $yearFounded,
        public ?string $annualSales,
        public ?string $numberEmployees,
        public ?string $primaryPhone,
        public ?string $website,
        public ?string $logoUrl,
        public ?string $logoTitle,
        public Address $address,
        public array $headings,
        public array $certifications,
        public array $certificationTotals,
        public array $products,
        public array $personnel,
        public array $brands,
        public array $social,
        public array $videos,
        public array $news,
        public array $whitepapers,
        public array $otherActivities,
        public bool $isMultiLocation,
        public bool $isAdvertiser,
        public bool $xometryVerified,
        public bool $isClaimed,
        public bool $isAffiliationPage,
        public ?string $mainLocationTgramsId,
        public ?string $mainLocationName,
        public ?string $heading,
        public ?string $searchMode,
        public DateTimeImmutable $scrapedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            tgramsId: (string) $data['tgramsId'],
            name: $data['name'],
            description: $data['description'] ?? null,
            type: $data['type'] ?? null,
            tier: $data['tier'] ?? null,
            yearFounded: isset($data['yearFounded']) ? (int) $data['yearFounded'] : null,
            annualSales: $data['annualSales'] ?? null,
            numberEmployees: $data['numberEmployees'] ?? null,
            primaryPhone: $data['primaryPhone'] ?? null,
            website: $data['website'] ?? null,
            logoUrl: $data['logoUrl'] ?? null,
            logoTitle: $data['logoTitle'] ?? null,
            address: Address::fromArray($data['address'] ?? []),
            headings: array_map(
                static fn (array $h) => Heading::fromArray($h),
                $data['headings'] ?? []
            ),
            certifications: array_map(
                static fn (array $c) => Certification::fromArray($c),
                $data['certifications'] ?? []
            ),
            certificationTotals: array_map(
                static fn (array $ct) => CertificationTotal::fromArray($ct),
                $data['certificationTotals'] ?? []
            ),
            products: array_map(
                static fn (array $p) => Product::fromArray($p),
                $data['products'] ?? []
            ),
            personnel: array_map(
                static fn (array $p) => Person::fromArray($p),
                $data['personnel'] ?? []
            ),
            brands: array_map(
                static fn (array $b) => Brand::fromArray($b),
                $data['brands'] ?? []
            ),
            social: array_map(
                static fn (array $s) => SocialLink::fromArray($s),
                $data['social'] ?? []
            ),
            videos: array_map(
                static fn (array $v) => Video::fromArray($v),
                $data['videos'] ?? []
            ),
            news: array_map(
                static fn (array $n) => NewsArticle::fromArray($n),
                $data['news'] ?? []
            ),
            whitepapers: array_map(
                static fn (array $w) => Whitepaper::fromArray($w),
                $data['whitepapers'] ?? []
            ),
            otherActivities: $data['otherActivities'] ?? [],
            isMultiLocation: $data['isMultiLocation'] ?? false,
            isAdvertiser: $data['isAdvertiser'] ?? false,
            xometryVerified: $data['xometryVerified'] ?? false,
            isClaimed: $data['isClaimed'] ?? false,
            isAffiliationPage: $data['isAffiliationPage'] ?? false,
            mainLocationTgramsId: isset($data['mainLocationTgramsId']) ? (string) $data['mainLocationTgramsId'] : null,
            mainLocationName: $data['mainLocationName'] ?? null,
            heading: $data['heading'] ?? null,
            searchMode: $data['searchMode'] ?? null,
            scrapedAt: new DateTimeImmutable($data['scrapedAt'] ?? 'now'),
        );
    }

    /**
     * Check if supplier has a certification matching the given pattern.
     */
    public function hasCertification(string $pattern): bool
    {
        foreach ($this->certifications as $cert) {
            if (stripos($cert->title, $pattern) !== false) {
                return true;
            }
        }

        return false;
    }
}
