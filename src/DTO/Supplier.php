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

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        /** @var array<int, array<string, mixed>> $headingsData */
        $headingsData = $data['headings'] ?? [];
        /** @var array<int, array<string, mixed>> $certificationsData */
        $certificationsData = $data['certifications'] ?? [];
        /** @var array<int, array<string, mixed>> $certificationTotalsData */
        $certificationTotalsData = $data['certificationTotals'] ?? [];
        /** @var array<int, array<string, mixed>> $productsData */
        $productsData = $data['products'] ?? [];
        /** @var array<int, array<string, mixed>> $personnelData */
        $personnelData = $data['personnel'] ?? [];
        /** @var array<int, array<string, mixed>> $brandsData */
        $brandsData = $data['brands'] ?? [];
        /** @var array<int, array<string, mixed>> $socialData */
        $socialData = $data['social'] ?? [];
        /** @var array<int, array<string, mixed>> $videosData */
        $videosData = $data['videos'] ?? [];
        /** @var array<int, array<string, mixed>> $newsData */
        $newsData = $data['news'] ?? [];
        /** @var array<int, array<string, mixed>> $whitepapersData */
        $whitepapersData = $data['whitepapers'] ?? [];
        /** @var array<int, string> $otherActivitiesData */
        $otherActivitiesData = $data['otherActivities'] ?? [];
        /** @var array<string, mixed> $addressData */
        $addressData = $data['address'] ?? [];

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
            address: Address::fromArray($addressData),
            headings: array_map(
                static fn (array $h): Heading => Heading::fromArray($h),
                $headingsData
            ),
            certifications: array_map(
                static fn (array $c): Certification => Certification::fromArray($c),
                $certificationsData
            ),
            certificationTotals: array_map(
                static fn (array $ct): CertificationTotal => CertificationTotal::fromArray($ct),
                $certificationTotalsData
            ),
            products: array_map(
                static fn (array $p): Product => Product::fromArray($p),
                $productsData
            ),
            personnel: array_map(
                static fn (array $p): Person => Person::fromArray($p),
                $personnelData
            ),
            brands: array_map(
                static fn (array $b): Brand => Brand::fromArray($b),
                $brandsData
            ),
            social: array_map(
                static fn (array $s): SocialLink => SocialLink::fromArray($s),
                $socialData
            ),
            videos: array_map(
                static fn (array $v): Video => Video::fromArray($v),
                $videosData
            ),
            news: array_map(
                static fn (array $n): NewsArticle => NewsArticle::fromArray($n),
                $newsData
            ),
            whitepapers: array_map(
                static fn (array $w): Whitepaper => Whitepaper::fromArray($w),
                $whitepapersData
            ),
            otherActivities: $otherActivitiesData,
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
