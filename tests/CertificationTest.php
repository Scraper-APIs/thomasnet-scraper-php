<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\Certification;

it('creates certification from complete data', function () {
    $data = [
        'id' => 408554,
        'code' => '175',
        'title' => 'AS9100D',
        'type' => 'QUALITY',
        'tier' => 'DOWNLOAD',
        'group' => 'AS9100',
        'scope' => 'For the control products and systems (BT CPS) business unit...',
        'imageUrl' => 'https://cdn.thomasnet.com/certifications/large/40/408554.png',
        'thumbnailUrl' => 'https://cdn.thomasnet.com/certifications/thumbs/40/408554.png',
        'url' => 'https://www.downloads.siemens.com/download-center/...',
        'date' => '03/05/2018',
        'isActive' => false,
    ];

    $cert = Certification::fromArray($data);

    expect($cert->id)->toBe(408554)
        ->and($cert->code)->toBe('175')
        ->and($cert->title)->toBe('AS9100D')
        ->and($cert->type)->toBe('QUALITY')
        ->and($cert->tier)->toBe('DOWNLOAD')
        ->and($cert->group)->toBe('AS9100')
        ->and($cert->scope)->toContain('control products')
        ->and($cert->imageUrl)->toContain('408554.png')
        ->and($cert->date)->toBe('03/05/2018')
        ->and($cert->isActive)->toBeFalse();
});

it('handles ISO 9001 certification', function () {
    $data = [
        'id' => 389564,
        'code' => '181',
        'title' => 'ISO 9001:2015',
        'type' => 'QUALITY',
        'group' => 'ISO 9001',
        'isActive' => true,
    ];

    $cert = Certification::fromArray($data);

    expect($cert->title)->toBe('ISO 9001:2015')
        ->and($cert->group)->toBe('ISO 9001')
        ->and($cert->isActive)->toBeTrue();
});

it('handles missing optional fields', function () {
    $data = [
        'id' => 123,
        'code' => 'TEST',
        'title' => 'Test Certification',
        'type' => 'DIVERSITY',
    ];

    $cert = Certification::fromArray($data);

    expect($cert->id)->toBe(123)
        ->and($cert->tier)->toBeNull()
        ->and($cert->group)->toBeNull()
        ->and($cert->scope)->toBeNull()
        ->and($cert->imageUrl)->toBeNull()
        ->and($cert->url)->toBeNull()
        ->and($cert->date)->toBeNull()
        ->and($cert->isActive)->toBeFalse();
});

it('casts id to integer', function () {
    $data = [
        'id' => '408554',
        'code' => '175',
        'title' => 'AS9100D',
        'type' => 'QUALITY',
    ];

    $cert = Certification::fromArray($data);

    expect($cert->id)->toBeInt()->toBe(408554);
});
