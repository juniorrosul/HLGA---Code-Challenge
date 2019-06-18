<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'breed_id',
        'name',
        'temperament',
        'life_span',
        'alt_names',
        'wikipedia_url',
        'origin',
        'weight_imperial',
        'experimental',
        'hairless',
        'natural',
        'rex',
        'suppressed_tail',
        'short_legs',
        'hypoallergenic',
        'adaptability',
        'affection_level',
        'country_code',
        'child_friendly',
        'dog_friendly',
        'energy_level',
        'grooming',
        'health_issues',
        'intelligence',
        'shedding_level',
        'social_needs',
        'stranger_friendly',
        'vocalisation',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'experimental' => 'boolean',
        'hairless' => 'boolean',
        'natural' => 'boolean',
        'rex' => 'boolean',
        'suppressed_tail' => 'boolean',
        'short_legs' => 'boolean',
        'hypoallergenic' => 'boolean',
        'adaptability' => 'integer',
        'affection_level' => 'integer',
        'child_friendly' => 'integer',
        'dog_friendly' => 'integer',
        'energy_level' => 'integer',
        'grooming' => 'integer',
        'health_issues' => 'integer',
        'intelligence' => 'integer',
        'shedding_level' => 'integer',
        'social_needs' => 'integer',
        'stranger_friendly' => 'integer',
        'vocalisation' => 'integer',
    ];
}
