<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/posts",
     *      tags={"Posts"},
     *      summary="Displays a list of items.",
     *      description="Returns list of items.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="description", type="string", example="description"),
     *              @OA\Property(property="created_at", type="timestamp", example="2022-07-21 14:46:56"),
     *              @OA\Property(property="updated_at", type="timestamp", example="2022-07-21 14:46:56"),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *      ),
     * )
     */
    public function index(Post $posts)
    {
        try
        {
            $posts = $posts->all();
            return PostResource::collection($posts);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 400);
        }
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
     *      path="/api/posts",
     *      tags={"Posts"},
     *      summary="Insert title and description of the topic.",
     *      description="This CRUD method will let insert a new data with parameters title and description.",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                      @OA\Property(
     *                          type="object",
     *                          @OA\Property(
     *                              property="title",
     *                              type="String",
     *                          ),
     *                          @OA\Property(
     *                              property="description",
     *                              type="String",
     *                          )
     *                      ),
     *                      example={
     *                          "title": "title",
     *                          "description": "description"
     *                      }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="description", type="string", example="description"),
     *              @OA\Property(property="created_at", type="timestamp", example="2022-07-21 14:46:56"),
     *              @OA\Property(property="updated_at", type="timestamp", example="2022-07-21 14:46:56"),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Invalid",
     *      ),
     * )
     */
    public function store(StorePostRequest $request)
    {
        try {
            $posts = Post::create($request->all());
            return new PostResource($posts);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception->getMessage()], 400);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/posts/{id}",
     *      operationId="getPostsById",
     *      tags={"Posts"},
     *      summary="This method will return a single post.",
     *      description="Returns a single post.",
     *      @OA\Parameter(
     *          name="id",
     *          description="Post id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *     @OA\Response(
     *     response=400,
     *     description="Invalid",
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function show(Post $post)
    {
        try {
            return new PostResource($post);
        } catch (ModelNotFoundException $exception) {
            return response()->json(["msg" => $exception -> getMessage()], 404);
        }
    }


//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\Post  $post
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Post $post)
//    {
//        //
//    }

    /**
     * @OA\Put(
     *      path="/api/posts/{id}",
     *      operationId="updateProject",
     *      tags={"Posts"},
     *      summary="Update a post.",
     *      description="Returns updated single post.",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="title",
     *                          type="String"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="String"
     *                      )
     *                  ),
     *                  example={
     *                      "title": "title",
     *                      "description": "description"
     *                  }
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(StorePostRequest $request, Post $post)
    {
        try
        {
            $post->update($request->all());
            return new PostResource($post);
        } catch (ModelNotFoundException $exception)
        {
            return response()->json(["msg" => $exception -> getMessage()], 404);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/posts/{id}",
     *      operationId="Delete the post.",
     *      tags={"Posts"},
     *      summary="Delete a post.",
     *      description="Returns deleted single post.",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Operation Successfully deleted",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Post $post)
    {
        try
        {
            $post->delete();
            return response() -> json(["msg" => $post . " is deleted!"], 204);
        } catch (ModelNotFoundException $exception) {
            return response() -> json(["msg" => $exception -> getMessage()], 404);
        }
    }
}
