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
     *
     * @return JsonResponse
     */
    public function show(BreedGetRequest $request)
    {
        $breeds = $this->breedContract->getByName($request->name);

        return response()
            ->json($breeds);
    }
}
