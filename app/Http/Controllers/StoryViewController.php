<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class StoryController extends Controller
{
    /**
     * Display explore posts page by fetching from backend API.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $response = Http::get(env('API_BASE_URL') . '/api/v1/story');

            if ($response->successful()) {
                $storys = $response->json()['data'] ?? [];
                return view('storys.explore', compact('storys'));
            } else {
                return view('storys.explore', ['storys' => [], 'error' => 'Failed to fetch storys']);
            }
        } catch (\Exception $e) {
            return view('storys.explore', ['storys' => [], 'error' => 'Connection error']);
        }
    }

    /**
     * Get all posts from backend API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $response = Http::get(env('API_BASE_URL') . '/api/v1/story/' . $id);

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



    public function destroy($id)
    {
        try {
            $response = Http::delete(env('API_BASE_URL') . '/api/v1/story/' . $id);

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
