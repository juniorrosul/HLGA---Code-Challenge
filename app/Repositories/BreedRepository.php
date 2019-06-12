<?php

namespace App\Repositories;

use App\Contracts\BreedContract;
use App\Breed;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;

class BreedRepository implements BreedContract
{
    /**
     * @param string $breedName
     *
     * @return Collection
     */
    public function getByName(string $breedName) : Collection
    {
        $breeds = Breed::where('name', 'like', '%'.$breedName.'%')->get();

        if (empty($breed)) {
            $breeds = $this->loadFromExternalApi($breedName);
        }

        return $breeds;
    }

    /**
     * @param string $id
     * @param string $name
     * @param string $temperament
     * @param string $lifeSpan
     * @param string $altNames
     * @param string $wikipediaUrl
     * @param string $origin
     * @param string $weightImperial
     * @param bool   $experimental
     * @param bool   $hairless
     * @param bool   $natural
     * @param bool   $rex
     * @param bool   $suppressedTail
     * @param bool   $shortLegs
     * @param bool   $hypoallergenic
     * @param int    $adaptability
     * @param int    $affectionLevel
     * @param string $countryCode
     * @param int    $childFriendly
     * @param int    $dogFriendly
     * @param int    $energyLevel
     * @param int    $grooming
     * @param int    $healthIssues
     * @param int    $intelligence
     * @param int    $sheddingLevel
     * @param int    $socialNeeds
     * @param int    $strangerFriendly
     * @param int    $vocalisation
     *
     * @return Breed
     */
    public function create(string $id, string $name, string $temperament, string $lifeSpan, string $altNames, string $wikipediaUrl, string $origin, string $weightImperial, bool $experimental, bool $hairless, bool $natural, bool $rex, bool $suppressedTail, bool $shortLegs, bool $hypoallergenic, int $adaptability, int $affectionLevel, string $countryCode, int $childFriendly, int $dogFriendly, int $energyLevel, int $grooming, int $healthIssues, int $intelligence, int $sheddingLevel, int $socialNeeds, int $strangerFriendly, int $vocalisation): Breed
    {
        // prevent duplicated
        $breed = Breed::firstOrCreate([
            'breed_id' => $id,
            'name' => $name,
            'temperament' => $temperament,
            'life_span' => $lifeSpan,
            'alt_names' => $altNames,
            'wikipedia_url' => $wikipediaUrl,
            'origin' => $origin,
            'weight_imperial' => $weightImperial,
            'experimental' => $experimental,
            'hairless' => $hairless,
            'natural' => $natural,
            'rex' => $rex,
            'suppressed_tail' => $suppressedTail,
            'short_legs' => $shortLegs,
            'hypoallergenic' => $hypoallergenic,
            'adaptability' => $adaptability,
            'affection_level' => $affectionLevel,
            'country_code' => $countryCode,
            'child_friendly' => $childFriendly,
            'dog_friendly' => $dogFriendly,
            'energy_level' => $energyLevel,
            'grooming' => $grooming,
            'health_issues' => $healthIssues,
            'intelligence' => $intelligence,
            'shedding_level' => $sheddingLevel,
            'social_needs' => $socialNeeds,
            'stranger_friendly' => $strangerFriendly,
            'vocalisation' => $vocalisation,
        ]);

        return $breed;
    }

    /**
     * @param string $breedName
     *
     * @return Collection
     */
    private function loadFromExternalApi(string $breedName) : Collection
    {
        $client = new Client([
            'headers' => [
                'x-api-key' => config('catapi.token'),
            ],
        ]);

        $response = $client->get('https://api.thecatapi.com/v1/breeds/search', [
            'query' => [
                'q' => $breedName,
            ],
        ]);

        $breedsApi = json_decode($response->getBody()->getContents());

        $breeds = new Collection();

        foreach ($breedsApi as $key => $breed) {

            \Log::debug('breed', compact('key', 'breed'));
            $current = $this->create(
                $breed->id,
                $breed->name,
                $breed->temperament,
                $breed->life_span,
                $breed->alt_names,
                $breed->wikipedia_url,
                $breed->origin,
                $breed->weight->imperial,
                $breed->experimental,
                $breed->hairless,
                $breed->natural,
                $breed->rex,
                $breed->suppressed_tail,
                $breed->short_legs,
                $breed->hypoallergenic,
                $breed->adaptability,
                $breed->affection_level,
                $breed->country_code,
                $breed->child_friendly,
                $breed->dog_friendly,
                $breed->energy_level,
                $breed->grooming,
                $breed->health_issues,
                $breed->intelligence,
                $breed->shedding_level,
                $breed->social_needs,
                $breed->stranger_friendly,
                $breed->vocalisation
            );

            $breeds->push($current);
        }

        return $breeds;
    }
}
