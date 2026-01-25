<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\CertificationTotal;

it('creates certification total from array', function () {
    $data = [
        'type' => 'QUALITY',
        'count' => 185,
    ];

    $total = CertificationTotal::fromArray($data);

    expect($total->type)->toBe('QUALITY')
        ->and($total->count)->toBe(185);
});

it('handles registration type', function () {
    $data = [
        'type' => 'REGISTRATION',
        'count' => 47,
    ];

    $total = CertificationTotal::fromArray($data);

    expect($total->type)->toBe('REGISTRATION')
        ->and($total->count)->toBe(47);
});

it('casts count to integer', function () {
    $data = [
        'type' => 'DIVERSITY',
        'count' => '12',
    ];

    $total = CertificationTotal::fromArray($data);

    expect($total->count)->toBeInt()->toBe(12);
});
