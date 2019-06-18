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

    /**
     *  Setup the test.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->breedContract = app(BreedContract::class);
    }

    public function testGetByIdEmpty()
    {
        $breedExpected = null;

        $breed = $this->breedContract->getById('sibe');

        $this->assertEquals($breedExpected, $breed);
    }

    public function testGetByID()
    {
        factory(Breed::class)->create($this->generateSibArray());

        $breedExpected = Breed::whereBreedId('sibe')->first();

        $breed = $this->breedContract->getById('sibe');

        $this->assertEquals($breedExpected, $breed);
    }

    /**
     *  Test get by name method from repository.
     */
    public function testGetByName()
    {
        factory(Breed::class)->create($this->generateSibArray());

        $breedExpected = Breed::where('name', 'like', 'sib%')->get();

        $breed = $this->breedContract->getByName('sib');

        $this->assertEquals($breedExpected, $breed);
    }

    /**
     * Test create method from repository
     */
    public function testCreate()
    {
        $this->breedContract->create(
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

        $this->assertDatabaseHas('breeds', $this->generateSibArray());
    }

    public function testCreateExistingContent()
    {
        factory(Breed::class)->create($this->generateSibArray());
        $this->breedContract->create(
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

        $this->assertDatabaseHas('breeds', $this->generateSibArray());
    }
}
