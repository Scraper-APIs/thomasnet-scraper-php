<?php

declare(strict_types=1);

use ThomasNetScraper\DTO\Brand;
use ThomasNetScraper\DTO\Person;
use ThomasNetScraper\DTO\SocialLink;
use ThomasNetScraper\DTO\Video;
use ThomasNetScraper\DTO\Product;

describe('Brand', function () {
    it('creates brand from array', function () {
        $brand = Brand::fromArray(['name' => 'Apogee']);

        expect($brand->name)->toBe('Apogee');
    });
});

describe('Person', function () {
    it('creates person with title', function () {
        $person = Person::fromArray([
            'name' => 'John Smith',
            'title' => 'VP of Engineering',
        ]);

        expect($person->name)->toBe('John Smith')
            ->and($person->title)->toBe('VP of Engineering');
    });

    it('handles missing title', function () {
        $person = Person::fromArray(['name' => 'Jane Doe']);

        expect($person->name)->toBe('Jane Doe')
            ->and($person->title)->toBeNull();
    });
});

describe('SocialLink', function () {
    it('creates social link', function () {
        $link = SocialLink::fromArray([
            'type' => 'linkedin',
            'url' => 'https://linkedin.com/company/siemens',
        ]);

        expect($link->type)->toBe('linkedin')
            ->and($link->url)->toContain('linkedin.com');
    });
});

describe('Video', function () {
    it('creates video with all fields', function () {
        $video = Video::fromArray([
            'title' => 'Company Overview',
            'url' => 'https://youtube.com/watch?v=abc123',
            'thumbnailUrl' => 'https://img.youtube.com/vi/abc123/0.jpg',
            'description' => 'Learn about our company.',
        ]);

        expect($video->title)->toBe('Company Overview')
            ->and($video->url)->toContain('youtube.com')
            ->and($video->thumbnailUrl)->toContain('abc123')
            ->and($video->description)->toBe('Learn about our company.');
    });

    it('handles missing optional fields', function () {
        $video = Video::fromArray(['title' => 'Demo Video']);

        expect($video->title)->toBe('Demo Video')
            ->and($video->url)->toBeNull()
            ->and($video->thumbnailUrl)->toBeNull()
            ->and($video->description)->toBeNull();
    });
});

describe('Product', function () {
    it('creates product with all fields', function () {
        $product = Product::fromArray([
            'name' => 'Industrial Motor',
            'description' => 'High-efficiency electric motor for industrial applications.',
            'imageUrl' => 'https://cdn.example.com/motor.jpg',
        ]);

        expect($product->name)->toBe('Industrial Motor')
            ->and($product->description)->toContain('electric motor')
            ->and($product->imageUrl)->toContain('motor.jpg');
    });

    it('handles missing optional fields', function () {
        $product = Product::fromArray(['name' => 'Basic Widget']);

        expect($product->name)->toBe('Basic Widget')
            ->and($product->description)->toBeNull()
            ->and($product->imageUrl)->toBeNull();
    });
});
