<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\Heading;

it('creates heading from complete data', function () {
    $data = [
        'headingId' => '171801',
        'name' => 'Accelerators: Linear',
        'familyName' => 'Accelerators',
        'description' => 'Worldwide manufacturer of digital linear accelerators for radiation therapy.',
        'url' => 'https://example.com/accelerators',
    ];

    $heading = Heading::fromArray($data);

    expect($heading->headingId)->toBe('171801')
        ->and($heading->name)->toBe('Accelerators: Linear')
        ->and($heading->familyName)->toBe('Accelerators')
        ->and($heading->description)->toContain('linear accelerators')
        ->and($heading->url)->toBe('https://example.com/accelerators');
});

it('handles missing optional fields', function () {
    $data = [
        'headingId' => '39774245',
        'name' => 'Access Control Systems',
    ];

    $heading = Heading::fromArray($data);

    expect($heading->headingId)->toBe('39774245')
        ->and($heading->name)->toBe('Access Control Systems')
        ->and($heading->familyName)->toBeNull()
        ->and($heading->description)->toBeNull()
        ->and($heading->url)->toBeNull();
});

it('casts headingId to string', function () {
    $data = [
        'headingId' => 171801,
        'name' => 'Test Heading',
    ];

    $heading = Heading::fromArray($data);

    expect($heading->headingId)->toBeString()->toBe('171801');
});
