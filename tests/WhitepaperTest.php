<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\Whitepaper;

it('creates whitepaper from complete data', function () {
    $data = [
        'title' => 'Case Study: Creating a Capable but Lower-Cost Finishing Machine',
        'shortDescription' => 'This case study examines the production of a cost-effective microfinishing machine.',
        'smallThumbnail' => 'https://cdn.thomasnet.com/kc/thumbs/1782.png',
        'docUrl' => '/knowledge/case-study-creating-a-capable-but-lower-cost-finishing-machine',
    ];

    $whitepaper = Whitepaper::fromArray($data);

    expect($whitepaper->title)->toContain('Finishing Machine')
        ->and($whitepaper->shortDescription)->toContain('microfinishing machine')
        ->and($whitepaper->smallThumbnail)->toContain('1782.png')
        ->and($whitepaper->docUrl)->toContain('/knowledge/');
});

it('handles missing optional fields', function () {
    $data = [
        'title' => 'The Case for Regenerative AC Drive Motors',
    ];

    $whitepaper = Whitepaper::fromArray($data);

    expect($whitepaper->title)->toBe('The Case for Regenerative AC Drive Motors')
        ->and($whitepaper->shortDescription)->toBeNull()
        ->and($whitepaper->smallThumbnail)->toBeNull()
        ->and($whitepaper->docUrl)->toBeNull();
});

it('handles whitepaper without thumbnail', function () {
    $data = [
        'title' => 'Energy Management Considerations',
        'shortDescription' => 'This paper presents a comprehensive approach to energy management.',
        'smallThumbnail' => null,
        'docUrl' => '/knowledge/energy-management',
    ];

    $whitepaper = Whitepaper::fromArray($data);

    expect($whitepaper->smallThumbnail)->toBeNull()
        ->and($whitepaper->docUrl)->toBe('/knowledge/energy-management');
});
