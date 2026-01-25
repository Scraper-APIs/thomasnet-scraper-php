<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\Address;

it('creates address from complete data', function () {
    $data = [
        'address1' => '300 New Jersey Avenue, N.W.',
        'address2' => 'Suite 1000',
        'city' => 'Washington',
        'state' => 'DC',
        'stateName' => 'District of Columbia',
        'zip' => '20001',
        'country' => 'USA',
        'latitude' => 38.91076058,
        'longitude' => -77.0167462,
    ];

    $address = Address::fromArray($data);

    expect($address->address1)->toBe('300 New Jersey Avenue, N.W.')
        ->and($address->address2)->toBe('Suite 1000')
        ->and($address->city)->toBe('Washington')
        ->and($address->state)->toBe('DC')
        ->and($address->stateName)->toBe('District of Columbia')
        ->and($address->zip)->toBe('20001')
        ->and($address->country)->toBe('USA')
        ->and($address->latitude)->toBe(38.91076058)
        ->and($address->longitude)->toBe(-77.0167462);
});

it('handles missing optional fields', function () {
    $address = Address::fromArray([
        'city' => 'Austin',
        'state' => 'TX',
    ]);

    expect($address->city)->toBe('Austin')
        ->and($address->state)->toBe('TX')
        ->and($address->address1)->toBeNull()
        ->and($address->address2)->toBeNull()
        ->and($address->zip)->toBeNull()
        ->and($address->latitude)->toBeNull()
        ->and($address->longitude)->toBeNull();
});

it('creates empty address from empty array', function () {
    $address = Address::fromArray([]);

    expect($address->address1)->toBeNull()
        ->and($address->city)->toBeNull()
        ->and($address->state)->toBeNull()
        ->and($address->country)->toBeNull();
});

it('casts coordinates to float', function () {
    $address = Address::fromArray([
        'latitude' => '38.91076058',
        'longitude' => '-77.0167462',
    ]);

    expect($address->latitude)->toBeFloat()
        ->and($address->longitude)->toBeFloat();
});
