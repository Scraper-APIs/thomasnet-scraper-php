<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

// Uses default TestCase

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

function getSampleSupplierData(): array
{
    return [
        'tgramsId' => '10035100',
        'name' => 'Siemens Corporation',
        'description' => 'Worldwide manufacturer of industrial products...',
        'tier' => 'NONE',
        'type' => 'S',
        'primaryPhone' => '(800) 743-6367',
        'website' => 'https://www.siemens.com/us/en/home.html',
        'address' => [
            'address1' => '300 New Jersey Avenue, N.W.',
            'address2' => 'Suite 1000',
            'city' => 'Washington',
            'state' => 'DC',
            'stateName' => 'District of Columbia',
            'zip' => '20001',
            'country' => 'USA',
            'latitude' => 38.91076058,
            'longitude' => -77.0167462,
        ],
        'annualSales' => '$250 Mil. and over',
        'numberEmployees' => '1000+',
        'logoUrl' => 'https://cdn.thomasnet.com/ritekit/siemens.com.png',
        'logoTitle' => 'Siemens Corporation Company Logo',
        'isAdvertiser' => false,
        'xometryVerified' => false,
        'isClaimed' => true,
        'isMultiLocation' => true,
        'isAffiliationPage' => false,
        'mainLocationTgramsId' => '10035100',
        'mainLocationName' => 'Siemens Corporation',
        'otherActivities' => ['C', 'F', 'I', 'M', 'R'],
        'headings' => [
            [
                'headingId' => '171801',
                'name' => 'Accelerators: Linear',
                'familyName' => 'Accelerators',
                'description' => 'Worldwide manufacturer of digital linear accelerators...',
                'url' => null,
            ],
        ],
        'certifications' => [
            [
                'id' => 408554,
                'code' => '175',
                'title' => 'AS9100D',
                'type' => 'QUALITY',
                'tier' => 'DOWNLOAD',
                'group' => 'AS9100',
                'scope' => 'For the control products and systems...',
                'imageUrl' => 'https://cdn.thomasnet.com/certifications/large/40/408554.png',
                'thumbnailUrl' => 'https://cdn.thomasnet.com/certifications/thumbs/40/408554.png',
                'url' => 'https://www.downloads.siemens.com/...',
                'date' => '03/05/2018',
                'isActive' => false,
            ],
            [
                'id' => 389564,
                'code' => '181',
                'title' => 'ISO 9001:2015',
                'type' => 'QUALITY',
                'tier' => 'DOWNLOAD',
                'group' => 'ISO 9001',
                'scope' => 'Manufacturing systems.',
                'imageUrl' => null,
                'thumbnailUrl' => null,
                'url' => null,
                'date' => '06/15/2017',
                'isActive' => true,
            ],
        ],
        'certificationTotals' => [
            ['type' => 'QUALITY', 'count' => 185],
            ['type' => 'REGISTRATION', 'count' => 47],
        ],
        'brands' => [
            ['name' => 'Apogee'],
            ['name' => 'ARTISTE'],
            ['name' => 'Axiom'],
        ],
        'news' => [
            [
                'id' => '40044866',
                'headline' => 'New G115D Drive System Available',
                'summary' => 'Comprised of the drive, motor and gear box...',
                'pubDate' => 'April 23, 2021',
                'image' => 'https://cfnewsads.thomasnet.com/images/small/40044/40044866.jpg',
                'type' => 'FULL_STORY',
            ],
        ],
        'whitepapers' => [
            [
                'title' => 'Case Study: Creating a Capable but Lower-Cost Finishing Machine',
                'shortDescription' => 'This case study examines the production...',
                'smallThumbnail' => 'https://cdn.thomasnet.com/kc/thumbs/1782.png',
                'docUrl' => '/knowledge/case-study-creating-a-capable-but-lower-cost-finishing-machine',
            ],
        ],
        'products' => [],
        'personnel' => [],
        'social' => [],
        'videos' => [],
        'searchMode' => 'name',
        'scrapedAt' => '2026-01-06T05:42:41.060954+00:00',
    ];
}
