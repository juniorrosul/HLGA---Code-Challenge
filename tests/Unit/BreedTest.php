<?php

namespace Tests\Unit;

use App\Breed;
use App\Contracts\BreedContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var BreedContract
     */
    private $breedContract;

    public function setUp(): void
    {
        parent::setUp();

        $this->breedContract = app(BreedContract::class);
    }

    public function testGetByName()
    {
        factory(Breed::class)->create($this->generateSibArray());

        $breedExpected = Breed::where('name', 'like', 'sib%')->get();

        $breed = $this->breedContract->getByName('sib');

        $this->assertEquals($breedExpected, $breed);
    }

    public function createTest()
    {
        $breedExpected = factory(Breed::class)->make($this->generateSibArray());

        $breed = $this->breedContract->create(
            'sibe',
            'Siberian',
            'Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate',
            '12 - 15',
            'Moscow Semi-longhair, HairSiberian Forest Cat',
            'https://en.wikipedia.org/wiki/Siberian_(cat)',
            'Russia',
            '8 - 16',
             false,
            false,
            true,
            false,
            false,
            false,
            true,
            5,
            5,
            'RU',
            4,
            5,
            5,
            2,
            2,
            5,
            3,
            4,
            3,
            1
        );

        $this->assertEquals($breedExpected, $breed);
    }

    /**
     * @return array
     */
    private function generateSibArray() : array
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
