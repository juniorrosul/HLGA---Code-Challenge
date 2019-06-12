<?php

namespace App\Http\Controllers;

use App\Contracts\BreedContract;
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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $breed = $this->breedContract->getByName($request->name);

        return response()
            ->json(compact('breed'));
    }
}
