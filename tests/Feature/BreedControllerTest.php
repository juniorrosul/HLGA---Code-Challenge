<?php

namespace Tests\Feature;

use App\Breed;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedControllerTest extends TestCase
{
    use RefreshDatabase;

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

    public function testMultipleRequests()
    {
        factory(Breed::class)->create($this->generateSibArray());

        $response = $this->get('/breeds/?name=sib');

        $response
            ->assertStatus(200)
            ->assertJson([$this->generateSibArray()]); // array of results

        $response2 = $this->get('/breeds/?name=sib');

        $response2
            ->assertStatus(200)
            ->assertJson([$this->generateSibArray()]); // array of results
    }

    public function testIdRequest()
    {
        $breed = factory(Breed::class)->create($this->generateSibArray());

        $response = $this->get('/breeds/sibe');

        $response
            ->assertStatus(200)
            ->assertJson($breed->toArray()); // array of results
    }
}
