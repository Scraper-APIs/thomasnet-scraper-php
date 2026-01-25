<?php

declare(strict_types=1);

use ThomasNetScraper\SearchMode;
use ThomasNetScraper\Area;

it('has correct search mode values', function () {
    expect(SearchMode::All->value)->toBe('all')
        ->and(SearchMode::Name->value)->toBe('name');
});

it('has correct area codes for major regions', function () {
    expect(Area::All->value)->toBe('NA')
        ->and(Area::TexasNorth->value)->toBe('NT')
        ->and(Area::TexasSouth->value)->toBe('GT')
        ->and(Area::CaliforniaNorth->value)->toBe('CN')
        ->and(Area::CaliforniaSouth->value)->toBe('CS')
        ->and(Area::NewYorkMetro->value)->toBe('DN')
        ->and(Area::NewYorkUpstate->value)->toBe('UN')
        ->and(Area::Michigan->value)->toBe('MI')
        ->and(Area::Illinois->value)->toBe('IL');
});

it('has correct area codes for Ohio and Pennsylvania regions', function () {
    expect(Area::OhioNorth->value)->toBe('NO')
        ->and(Area::OhioSouth->value)->toBe('SO')
        ->and(Area::PennsylvaniaEast->value)->toBe('EP')
        ->and(Area::PennsylvaniaWest->value)->toBe('WP');
});

it('has correct area codes for Canadian provinces', function () {
    expect(Area::Ontario->value)->toBe('ON')
        ->and(Area::Quebec->value)->toBe('QC')
        ->and(Area::Alberta->value)->toBe('AB')
        ->and(Area::BritishColumbia->value)->toBe('BC');
});

it('can create search mode from string value', function () {
    expect(SearchMode::from('all'))->toBe(SearchMode::All)
        ->and(SearchMode::from('name'))->toBe(SearchMode::Name);
});

it('can create area from string value', function () {
    expect(Area::from('MI'))->toBe(Area::Michigan)
        ->and(Area::from('NT'))->toBe(Area::TexasNorth)
        ->and(Area::from('ON'))->toBe(Area::Ontario);
});
