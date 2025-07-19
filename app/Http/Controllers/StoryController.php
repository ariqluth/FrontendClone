<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    /**
     * Display explore posts page by fetching from backend API.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $token = $request->session()->get('accessToken');
            $storyResponse = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->get('http://localhost:3000/api/v1/story');

            $viewedResponse = Http::asForm()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:3000/api/v1/storyView', [
                'user_id' => Auth::id()
            ]);

            if ($storyResponse->successful()) {
                $stories = $storyResponse->json()['data'] ?? [];
                $viewedStories = $viewedResponse->successful() ? collect($viewedResponse->json()['data'])->pluck('story_id')->all() : [];

                foreach ($stories as &$story) {
                    $story['is_viewed'] = in_array($story['id'], $viewedStories);
                }
          
                return view('layouts.app', compact('stories'));
            } else {
                return view('layouts.app', ['stories' => [], 'error' => 'Failed to fetch stories']);
            }
        } catch (\Exception $e) {
            return view('layouts.app', ['stories' => [], 'error' => 'Connection error: ' . $e->getMessage()]);
        }
    }

    /**
     * Get all posts from backend API.
     *
     * @return \Illuminate\Http\JsonResponse
     */ 
    public function show(Request $request, $id)
    {
        try {
            $token = $request->session()->get('accessToken');
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:3000/api/v1/story/' . $id);

            if ($response->successful()) {
                return view('storys.all', ['story' => $response->views()]);
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
        
    }

    public function destroy(Request $request, $id)
    {
        try {
            $token = $request->session()->get('accessToken');
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete('http://localhost:3000/api/v1/story/' . $id);

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
