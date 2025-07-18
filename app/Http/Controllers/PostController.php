<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display explore posts page by fetching from backend API.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $response = Http::get(env('API_BASE_URL') . '/api/v1/posts');

            if ($response->successful()) {
                $posts = $response->json()['data'] ?? [];
                return view('posts.explore', compact('posts'));
            } else {
                return view('posts.explore', ['posts' => [], 'error' => 'Failed to fetch posts']);
            }
        } catch (\Exception $e) {
            return view('posts.explore', ['posts' => [], 'error' => 'Connection error']);
        }
    }

    /**
     * Get all posts from backend API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPosts()
    {
        try {
            $response = Http::get(env('API_BASE_URL') . '/api/v1/posts');

            if ($response->successful()) {
                return response()->json($response->json(), $response->status());
            } else {
                return response()->json($response->json(), $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to backend service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a new post via backend API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:1000',
            'imageUrl' => 'nullable|string|url',
            'authorId' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $response = Http::post(env('API_BASE_URL') . '/api/v1/posts', [
                'content' => $request->content,
                'imageUrl' => $request->imageUrl,
                'authorId' => $request->authorId,
            ]);

            if ($response->successful()) {
                return response()->json($response->json(), $response->status());
            } else {
                return response()->json($response->json(), $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to backend service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get post details from backend API.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $response = Http::get(env('API_BASE_URL') . '/api/v1/posts/' . $id);

            if ($response->successful()) {
                return response()->json($response->json(), $response->status());
            } else {
                return response()->json($response->json(), $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to backend service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete post via backend API.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $response = Http::delete(env('API_BASE_URL') . '/api/v1/posts/' . $id);

            if ($response->successful()) {
                return response()->json($response->json(), $response->status());
            } else {
                return response()->json($response->json(), $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to backend service',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
