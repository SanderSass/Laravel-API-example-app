<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FreedomResource;
use App\Models\Freedom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FreedomContoller extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/freedom",
     *      tags={"Freedom"},
     *      summary="Displays a list of contries with freedom index.",
     *      description="Returns list of countries with conutry freedom indexes.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="year", type="number", example=2015),
     *              @OA\Property(property="iso_code", type="string", example="AUT"),
     *              @OA\Property(property="country", type="string", example="Austria"),
     *              @OA\Property(property="personal_freedom_score", type="Float", example=9.38),
     *              @OA\Property(property="economic_freedom_score", type="Float", example=7.66),
     *              @OA\Property(property="human_freedom_score", type="Float", example=8.52),
     *              @OA\Property(property="human_freedom_rank", type="integer", example=12),
     *              @OA\Property(property="human_freedom_quartile", type="integer", example=1),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *      ),
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        $freedoms = Freedom::all();
        return FreedomResource::collection($freedoms);
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }


    /**
     * @OA\Post(
     *      path="/api/freedom",
     *      tags={"Freedom"},
     *      summary="Insert new data of country freedom indexes.",
     *      description="This CRUD method will let to insert a new data corresponding with freedom raw data of the country.",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                      @OA\Property(
     *                          type="object",
     *                          @OA\Property(
     *                              property="year",
     *                              type="integer",
     *                          ),
     *                          @OA\Property(
     *                              property="iso_code",
     *                              type="String",
     *                          ),
     *                          @OA\Property(
     *                              property="country",
     *                          type="String",
     *                          ),
     *                          @OA\Property(
     *                              property="personal_freedom_score",
     *                              type="Float",
     *                          ),
     *                          @OA\Property(
     *                              property="economic_freedom_score",
     *                              type="Float",
     *                          ),
     *                          @OA\Property(
     *                              property="human_freedom_score",
     *                              type="Float",
     *                          ),
     *                          @OA\Property(
     *                              property="human_freedom_rank",
     *                              type="Integer",
     *                          ),
     *                          @OA\Property(
     *                              property="human_freedom_quartile",
     *                              type="Integer",
     *                          ),
     *                      ),
     *                      example={
     *                          "year": 2015,
     *                          "iso_code": "AUT",
     *                          "country": "Austria",
     *                          "personal_freedom_score": 9.38,
     *                          "economic_freedom_score": 7.66,
     *                          "human_freedom_score": 8.52,
     *                          "human_freedom_rank": 12,
     *                          "human_freedom_quartile": 1,
     *                      }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="year", type="number", example=2015),
     *              @OA\Property(property="iso_code", type="string", example="AUT"),
     *              @OA\Property(property="country", type="string", example="Austria"),
     *              @OA\Property(property="personal_freedom_score", type="Float", example=9.38),
     *              @OA\Property(property="economic_freedom_score", type="Float", example=7.66),
     *              @OA\Property(property="human_freedom_score", type="Float", example=8.52),
     *              @OA\Property(property="human_freedom_rank", type="integer", example=12),
     *              @OA\Property(property="human_freedom_quartile", type="integer", example=1),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *      ),
     * )
     */
    public function store(Request $request)
    {
        $freedoms = Freedom::create($request->all());
        return new FreedomResource($freedoms);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Freedom  $freedom
     * @return \Illuminate\Http\Response
     */
    public function show(Freedom $freedom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Freedom  $freedom
     * @return \Illuminate\Http\Response
     */
    public function edit(Freedom $freedom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Freedom  $freedom
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $year, $country): \Illuminate\Http\JsonResponse
    {
        $freedom = (new Freedom)->find($year, $country);
        $freedom->update($request->all());
        return (new FreedomResource($freedom))
            ->response()
            ->json(['message' => 'Freedom updated successfully.'], 200)
            ->setStatusCode(ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Freedom  $freedom
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Freedom $freedom)
    {
        $freedom->delete();
        return response()->json(['message' => 'Deleted successfully.'], 204);
    }
}
