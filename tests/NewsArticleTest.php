<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\NewsArticle;

it('creates news article from complete data', function () {
    $data = [
        'id' => '40044866',
        'headline' => 'New G115D Drive System Available in Wall and Motor-Mount Version',
        'summary' => 'Comprised of the drive, motor and gear box, this new distributed drive system...',
        'pubDate' => 'April 23, 2021',
        'image' => 'https://cfnewsads.thomasnet.com/images/small/40044/40044866.jpg',
        'type' => 'FULL_STORY',
    ];

    $article = NewsArticle::fromArray($data);

    expect($article->id)->toBe('40044866')
        ->and($article->headline)->toContain('G115D Drive System')
        ->and($article->summary)->toContain('drive, motor and gear box')
        ->and($article->pubDate)->toBe('April 23, 2021')
        ->and($article->image)->toContain('40044866.jpg')
        ->and($article->type)->toBe('FULL_STORY');
});

it('handles company story type', function () {
    $data = [
        'id' => '40044731',
        'headline' => 'Siemens Gamesa to Supply Turbines',
        'type' => 'COMPANY_STORY',
    ];

    $article = NewsArticle::fromArray($data);

    expect($article->type)->toBe('COMPANY_STORY')
        ->and($article->image)->toBeNull();
});

it('handles missing optional fields', function () {
    $data = [
        'id' => '123',
        'headline' => 'Test Headline',
    ];

    $article = NewsArticle::fromArray($data);

    expect($article->id)->toBe('123')
        ->and($article->headline)->toBe('Test Headline')
        ->and($article->summary)->toBeNull()
        ->and($article->pubDate)->toBeNull()
        ->and($article->image)->toBeNull()
        ->and($article->type)->toBeNull();
});

it('casts id to string', function () {
    $data = [
        'id' => 40044866,
        'headline' => 'Test',
    ];

    $article = NewsArticle::fromArray($data);

    expect($article->id)->toBeString()->toBe('40044866');
});
