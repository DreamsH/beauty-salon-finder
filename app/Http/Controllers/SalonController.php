<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Resources\SalonCollection;
use App\Models\Salon;
use App\Sorts\SalonServiceDisplaySort;
use App\Sorts\SalonServiceIdSort;
use App\Sorts\SalonServiceNameSort;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
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
     *          name="filter[id]",
     *          @OA\Schema(
     *              type="number",
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="filter[name]",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="filter[city]",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="filter[serviceId]",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="filter[serviceName]",
     *          @OA\Schema(
     *              type="string",
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="filter[serviceDisplay]",
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
     *                "id",
     *                "-id",
     *                "name",
     *                "-name",
     *                "city",
     *                "-city",
     *                "service_id",
     *                "-service_id",
     *                "service_name",
     *                "-service_name",
     *                "service_display",
     *                "-service_display"
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
        ->with('services')
        ->allowedFilters([
            AllowedFilter::scope("id"),
            AllowedFilter::scope("name"),
            AllowedFilter::scope("city"),
            AllowedFilter::scope("serviceId"),
            AllowedFilter::scope("serviceName"),
            AllowedFilter::scope("serviceDisplay"),
        ])
        ->allowedSorts(
            AllowedSort::field("name", "salons.name"),
            AllowedSort::field("id","salons.external_id"),
            AllowedSort::field("city","salons.city"),
            AllowedSort::custom("service_id", new SalonServiceIdSort),
            AllowedSort::custom("service_name", new SalonServiceNameSort),
            AllowedSort::custom("service_display", new SalonServiceDisplaySort),
        );

        if($request->perPage)
            return new SalonCollection($salons->paginate($request->perPage, ['*'], 'page', $request->page));
        else
            return new SalonCollection($salons->paginate(PHP_INT_MAX));
    }
}
