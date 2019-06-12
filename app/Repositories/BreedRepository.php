<?php

namespace App\Repositories;

use App\Contracts\BreedContract;
use App\Breed;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
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
        $breeds = Breed::where('name', 'like', $breedName.'%')->get();
        
        if (empty($breeds) or $breeds->count() == 0) {
            \Log::info('empty breeds');
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

        try {
            $response = $client->get('https://api.thecatapi.com/v1/breeds/search', [
                'query' => [
                    'q' => $breedName,
                ],
            ]);
            $breedsApi = json_decode($response->getBody()->getContents());
        } catch (ConnectException $e) {
            $breedsApi = [];
        }


        $breeds = new Collection();

        foreach ($breedsApi as $key => $breed) {

            \Log::debug('breed', compact('key', 'breed'));
            $current = $this->create(
                $breed->id,
                empty($breed->name) ? '' : $breed->name,
                empty($breed->temperament) ? '' : $breed->temperament,
                empty($breed->life_span) ? '' : $breed->life_span,
                empty($breed->alt_names) ? '' : $breed->alt_names,
                empty($breed->wikipedia_url) ? '' : $breed->wikipedia_url,
                empty($breed->origin) ? '' : $breed->origin,
                empty($breed->weight->imperial) ? '' : $breed->weight->imperial,
                empty($breed->experimental) ? false : $breed->experimental,
                empty($breed->hairless) ? false : $breed->hairless,
                empty($breed->natural) ? false : $breed->natural,
                empty($breed->rex) ? false : $breed->rex,
                empty($breed->suppressed_tail) ? false : $breed->suppressed_tail,
                empty($breed->short_legs) ? false : $breed->short_legs,
                empty($breed->hypoallergenic) ? false : $breed->hypoallergenic,
                empty($breed->adaptability) ? 1 : $breed->adaptability,
                empty($breed->affection_level) ? 1 : $breed->affection_level,
                $breed->country_code,
                empty($breed->child_friendly) ? 1 : $breed->child_friendly,
                empty($breed->dog_friendly) ? 1 : $breed->dog_friendly,
                empty($breed->energy_level) ? 1 : $breed->energy_level,
                empty($breed->grooming) ? 1 : $breed->grooming,
                empty($breed->health_issues) ? 1 : $breed->health_issues,
                empty($breed->intelligence) ? 1 : $breed->intelligence,
                empty($breed->shedding_level) ? 1 : $breed->shedding_level,
                empty($breed->social_needs) ? 1 : $breed->social_needs,
                empty($breed->stranger_friendly) ? 1 : $breed->stranger_friendly,
                empty($breed->vocalisation) ? 1 : $breed->vocalisation
            );

            $breeds->push($current);
        }

        return $breeds;
    }
}
