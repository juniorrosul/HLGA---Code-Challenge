<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @return array
     */
    protected function generateSibArray() : array
    {
        return [
            'breed_id' => 'sibe',
            'name' => 'Siberian',
            'temperament' => 'Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate',
            'life_span' => '12 - 15',
            'alt_names' => 'Moscow Semi-longhair, HairSiberian Forest Cat',
            'wikipedia_url' => 'https://en.wikipedia.org/wiki/Siberian_(cat)',
            'origin' => 'Russia',
            'weight_imperial' => '8 - 16',
            'experimental' => false,
            'hairless' => false,
            'natural' => true,
            'rex' => false,
            'suppressed_tail' => false,
            'short_legs' => false,
            'hypoallergenic' => true,
            'adaptability' => 5,
            'affection_level' => 5,
            'country_code' => 'RU',
            'child_friendly' => 4,
            'dog_friendly' => 5,
            'energy_level' => 5,
            'grooming' => 2,
            'health_issues' => 2,
            'intelligence' => 5,
            'shedding_level' => 3,
            'social_needs' => 4,
            'stranger_friendly' => 3,
            'vocalisation' => 1,
        ];
    }
}
