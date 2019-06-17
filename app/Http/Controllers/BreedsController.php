<?php

namespace App\Http\Controllers;

use App\Contracts\BreedContract;
use App\Http\Requests\BreedGetRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class BreedsController
 *
 * @package App\Http\Controllers
 */
class BreedsController extends Controller
{
    /**
     * @var BreedContract
     */
    private $breedContract;

    /**
     * BreedsController constructor.
     *
     * @param BreedContract $breedContract
     */
    public function __construct(BreedContract $breedContract)
    {
        $this->breedContract = $breedContract;
    }

    /**
     * @param BreedGetRequest $request
     * @queryParam name required The breed initial part of name.
     * @response {[
     *               {
     *                   "breed_id": "sibe",
     *                   "name": "Siberian",
     *                   "temperament": "Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate",
     *                   "life_span": "12 - 15",
     *                   "alt_names": "Moscow Semi-longhair, HairSiberian Forest Cat",
     *                   "wikipedia_url": "https:\/\/en.wikipedia.org\/wiki\/Siberian_(cat)",
     *                   "origin": "Russia",
     *                   "weight_imperial": "8 - 16",
     *                   "experimental": false,
     *                   "hairless": false,
     *                   "natural": true,
     *                   "rex": false,
     *                   "suppressed_tail": false,
     *                   "short_legs": false,
     *                   "hypoallergenic": true,
     *                   "adaptability": 5,
     *                   "affection_level": 5,
     *                   "country_code": "RU",
     *                   "child_friendly": 4,
     *                   "dog_friendly": 5,
     *                   "energy_level": 5,
     *                   "grooming": 2,
     *                   "health_issues": 2,
     *                   "intelligence": 5,
     *                   "shedding_level": 3,
     *                   "social_needs": 4,
     *                   "stranger_friendly": 3,
     *                   "vocalisation": 1,
     *                   "updated_at": "2019-06-17 13:03:29",
     *                   "created_at": "2019-06-17 13:03:29",
     *                   "id": 4
     *              }
     * ]}
     *
     * @return JsonResponse
     */
    public function index(BreedGetRequest $request)
    {
        $breeds = $this->breedContract->getByName($request->name);

        return response()
            ->json($breeds);
    }

    public function show(Request $request)
    {
        $breed = $this->breedContract->getById($request->breedId);

        return response()
            ->json($breed);
    }
}
