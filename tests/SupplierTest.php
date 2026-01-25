<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\Address;
use ThomasNetScraper\DTO\Brand;
use ThomasNetScraper\DTO\Certification;
use ThomasNetScraper\DTO\Heading;
use ThomasNetScraper\DTO\NewsArticle;
use ThomasNetScraper\DTO\Supplier;
use ThomasNetScraper\DTO\Whitepaper;

it('creates supplier from array', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->tgramsId)->toBe('10035100')
        ->and($supplier->name)->toBe('Siemens Corporation')
        ->and($supplier->tier)->toBe('NONE')
        ->and($supplier->type)->toBe('S')
        ->and($supplier->primaryPhone)->toBe('(800) 743-6367')
        ->and($supplier->website)->toBe('https://www.siemens.com/us/en/home.html')
        ->and($supplier->annualSales)->toBe('$250 Mil. and over')
        ->and($supplier->numberEmployees)->toBe('1000+')
        ->and($supplier->isMultiLocation)->toBeTrue()
        ->and($supplier->isClaimed)->toBeTrue()
        ->and($supplier->xometryVerified)->toBeFalse()
        ->and($supplier->searchMode)->toBe('name');
});

it('creates address from supplier data', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->address)->toBeInstanceOf(Address::class)
        ->and($supplier->address->address1)->toBe('300 New Jersey Avenue, N.W.')
        ->and($supplier->address->address2)->toBe('Suite 1000')
        ->and($supplier->address->city)->toBe('Washington')
        ->and($supplier->address->state)->toBe('DC')
        ->and($supplier->address->stateName)->toBe('District of Columbia')
        ->and($supplier->address->zip)->toBe('20001')
        ->and($supplier->address->country)->toBe('USA')
        ->and($supplier->address->latitude)->toBe(38.91076058)
        ->and($supplier->address->longitude)->toBe(-77.0167462);
});

it('creates certifications array', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->certifications)->toHaveCount(2)
        ->and($supplier->certifications[0])->toBeInstanceOf(Certification::class)
        ->and($supplier->certifications[0]->title)->toBe('AS9100D')
        ->and($supplier->certifications[0]->type)->toBe('QUALITY')
        ->and($supplier->certifications[1]->title)->toBe('ISO 9001:2015');
});

it('creates headings array', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->headings)->toHaveCount(1)
        ->and($supplier->headings[0])->toBeInstanceOf(Heading::class)
        ->and($supplier->headings[0]->headingId)->toBe('171801')
        ->and($supplier->headings[0]->name)->toBe('Accelerators: Linear')
        ->and($supplier->headings[0]->familyName)->toBe('Accelerators');
});

it('creates brands array', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->brands)->toHaveCount(3)
        ->and($supplier->brands[0])->toBeInstanceOf(Brand::class)
        ->and($supplier->brands[0]->name)->toBe('Apogee')
        ->and($supplier->brands[1]->name)->toBe('ARTISTE')
        ->and($supplier->brands[2]->name)->toBe('Axiom');
});

it('creates news array', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->news)->toHaveCount(1)
        ->and($supplier->news[0])->toBeInstanceOf(NewsArticle::class)
        ->and($supplier->news[0]->id)->toBe('40044866')
        ->and($supplier->news[0]->headline)->toBe('New G115D Drive System Available')
        ->and($supplier->news[0]->type)->toBe('FULL_STORY');
});

it('creates whitepapers array', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->whitepapers)->toHaveCount(1)
        ->and($supplier->whitepapers[0])->toBeInstanceOf(Whitepaper::class)
        ->and($supplier->whitepapers[0]->title)->toBe('Case Study: Creating a Capable but Lower-Cost Finishing Machine');
});

it('parses scrapedAt as DateTimeImmutable', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->scrapedAt)->toBeInstanceOf(DateTimeImmutable::class)
        ->and($supplier->scrapedAt->format('Y-m-d'))->toBe('2026-01-06');
});

it('has certification matching pattern', function () {
    $supplier = Supplier::fromArray(getSampleSupplierData());

    expect($supplier->hasCertification('ISO 9001'))->toBeTrue()
        ->and($supplier->hasCertification('AS9100'))->toBeTrue()
        ->and($supplier->hasCertification('ISO 14001'))->toBeFalse();
});

it('handles missing optional fields', function () {
    $minimal = [
        'tgramsId' => '123',
        'name' => 'Test Company',
        'scrapedAt' => '2026-01-01T00:00:00Z',
    ];

    $supplier = Supplier::fromArray($minimal);

    expect($supplier->tgramsId)->toBe('123')
        ->and($supplier->name)->toBe('Test Company')
        ->and($supplier->description)->toBeNull()
        ->and($supplier->yearFounded)->toBeNull()
        ->and($supplier->certifications)->toBeEmpty()
        ->and($supplier->headings)->toBeEmpty()
        ->and($supplier->isMultiLocation)->toBeFalse();
});
