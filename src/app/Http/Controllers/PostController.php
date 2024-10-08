<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Post::all());
    }

    /**
     * Display a listing of the resource by author.
     */
    public function postsByAuthor(User $author): JsonResponse
    {
        return response()->json($author->posts()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        return response()->json(Post::query()->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post): JsonResponse
    {
       $post->update($request->validated());
       return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): void
    {
        $post->delete();
    }
}
