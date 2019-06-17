<?php

namespace Tests\Feature;

use App\Breed;
use App\Contracts\BreedContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->breedContract = app(BreedContract::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEmptyReturn()
    {
        $response = $this->get('/breeds/?name=sib');

        $response
            ->assertStatus(200)
            ->assertJson([], true);
    }

    public function testNotEmptyReturn()
    {
        factory(Breed::class)->create($this->generateSibArray());

        $response = $this->get('/breeds/?name=sib');

        $response
            ->assertStatus(200)
            ->assertJson([$this->generateSibArray()]); // array of results
    }
}
