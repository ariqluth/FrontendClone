<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LikeController extends Controller
{
    /**
     * Get all likes for a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $postId = null)
    {
        try {
            $token = $request->session()->get('accessToken');
            
            $url = $postId ? "http://localhost:3000/api/v1/like/{$postId}" : "http://localhost:3000/api/v1/like";
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get($url);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json()
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get likes',
                    'errors' => $response->json()
                ], $response->status());
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
     * Store a like for a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $postId)
    {
        try {
            $token = $request->session()->get('accessToken');
            $user = $request->session()->get('user');
            $userId = is_array($user) ? $user['id'] : (is_object($user) ? $user->id : null);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post('http://localhost:3000/api/v1/like', [
                'postId' => $postId,
                'userId' => $userId
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Post liked successfully',
                    'data' => $response->json()
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to like post',
                    'errors' => $response->json()
                ], $response->status());
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
     * Remove a like from a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $postId)
    {
        try {
            $token = $request->session()->get('accessToken');
            $user = $request->session()->get('user');
            $userId = is_array($user) ? $user['id'] : (is_object($user) ? $user->id : null);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete('http://localhost:3000/api/v1/like', [
                'postId' => $postId,
                'userId' => $userId
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Like removed successfully',
                    'data' => $response->json()
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove like',
                    'errors' => $response->json()
                ], $response->status());
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
