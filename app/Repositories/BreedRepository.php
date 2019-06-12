<?php

namespace App\Repositories;

use App\Contracts\BreedContract;
use App\Breed;
use GuzzleHttp\Client;
use stdClass;

class BreedRepository implements BreedContract
{
    public function getByName(string $breedId): Breed
    {
        $breed = Breed::where('breed_id', $breedId)->first();

        if (empty($breed)) {
            $breedApi = $this->loadFromExternalApi($breedId);

            $breed = $this->create(
                $breedApi->id,
                $breedApi->name,
                $breedApi->temperament,
                $breedApi->life_span,
                $breedApi->alt_names,
                $breedApi->wikipedia_url,
                $breedApi->origin,
                $breedApi->weight_imperial,
                $breedApi->experimental,
                $breedApi->hairless,
                $breedApi->natural,
                $breedApi->rex,
                $breedApi->suppress_tail,
                $breedApi->short_legs,
                $breedApi->hypoallergenic,
                $breedApi->adaptability,
                $breedApi->affection_level,
                $breedApi->country_code,
                $breedApi->child_friendly,
                $breedApi->dog_friendly,
                $breedApi->energy_level,
                $breedApi->grooming,
                $breedApi->health_issues,
                $breedApi->intelligence,
                $breedApi->shedding_level,
                $breedApi->social_needs,
                $breedApi->stranger_friendly,
                $breedApi->vocalisation
            );
        }

        return $breed;
    }

    public function create(string $id, string $name, string $temperament, string $lifeSpan, string $altNames, string $wikipediaUrl, string $origin, string $weightImperial, bool $experimental, bool $hairless, bool $natural, bool $rex, bool $suppressTail, bool $shortLegs, bool $hypoallergenic, int $adaptability, int $affectionLevel, string $countryCode, int $childFriendly, int $dogFriendly, int $energyLevel, int $grooming, int $healthIssues, int $intelligence, int $sheddingLevel, int $socialNeeds, int $strangerFriendly, int $vocalisation): Breed
    {
        return new Breed();
    }

    private function loadFromExternalApi(string $breedId) : stdClass
    {
        $client = new Client([
            'headers' => [
                'x-api-key' => config('catapi.token'),
            ],
        ]);

        $response = $client->get('https://api.thecatapi.com/v1/breeds/search', [
            'name' => $breedId,
        ]);

        $breeds = json_decode($response->getBody()->getContents());

        print_r(compact('breeds', 'breedId'));

        foreach ($breeds as $key => $breed) {
            print_r(compact('key', 'breed'));
        }
    }
}
