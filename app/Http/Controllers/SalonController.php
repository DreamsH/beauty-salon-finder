<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Resources\SalonCollection;
use App\Models\Salon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SalonController extends Controller
{
    /**
     * Salons
     * @OA\Get (
     *     path="/api/salons",
     *     tags={"Salon"},
     *     summary="Get salons",
     *       security={
     *           {"API key": {}},
     *     },
     *     @OA\Parameter(
     *          in="query",
     *          name="filter[name]",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/pagination-page",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/pagination-perPage",
     *     ),
     *     @OA\Parameter(
     *        in="query",
     *        name="sort",
     *        description="Sort by column.",
     *        @OA\Schema(
     *            type="string",
     *            enum={
     *                "name",
     *                "-name",
     *            },
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          content={
     *              @OA\MediaType(
     *                  mediaType="application/json",
     *                  @OA\Schema(
     *                      @OA\Property(
     *                          property="salons",
     *                          type="array",
     *                          description="List of salons",
     *                          @OA\Items(ref="#/components/schemas/SalonResource")
     *                      ),
     *                      @OA\Property(
     *                          property="links",
     *                          ref="#/components/schemas/PaginationLinksResponse"
     *                      ),
     *                      @OA\Property(
     *                          property="meta",
     *                          ref="#/components/schemas/PaginationMetaResponse"
     *                      )
     *                  ),
     *                  example={
     *                      "salons": {
     *                          {
     *                              "id": 1,
     *                              "name": "Studio Stylizacji",
     *                              "city": "Warszawa",
     *                              "services": {
     *                                  {
     *                                      "id": 1,
     *                                      "name": "Makijaż biznesowy",
     *                                      "price": {
     *                                          "currency": "zł",
     *                                          "display": "160 zł"
     *                                      }
     *                                  }
     *                              }
     *                          }
     *                      }
     *                  }
     *              )
     *          }
     *      )
     * )
     */
    public function index(PaginationRequest $request)
    {
        $salons = QueryBuilder::for(Salon::class)
        ->allowedFilters([
            AllowedFilter::scope("name")
        ])
        ->defaultSort("name")
        ->allowedSorts(["name"]);

        if($request->perPage)
            return new SalonCollection($salons->paginate($request->perPage, ['*'], 'page', $request->page));
        else
            return new SalonCollection($salons->paginate(PHP_INT_MAX));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
