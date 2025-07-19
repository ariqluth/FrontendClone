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
    public function index(Request $request)
    {
        try {
            $token = $request->session()->get('accessToken');
            
            // Fetch stories
            $storyResponse = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->get('http://localhost:3000/api/v1/story');

            // Debug story response
            // dd('Story Response:', $storyResponse->json());

            $user = $request->session()->get('user');
            $userId = is_array($user) ? $user['id'] : (is_object($user) ? $user->id : null);
            
            $viewedResponse = Http::asForm()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('http://localhost:3000/api/v1/storyView', [
                'user_id' => $userId
            ]);

            $stories = [];
            if ($storyResponse->successful()) {
                $storyData = $storyResponse->json();
                $stories = $storyData['data'] ?? $storyData ?? [];
            }

            $viewedStories = [];
            if ($viewedResponse->successful()) {
                $viewedData = $viewedResponse->json();
                $viewedStories = collect($viewedData['data'] ?? $viewedData ?? [])->pluck('story_id')->all();
            }

            foreach ($stories as &$story) {
                $story['is_viewed'] = in_array($story['id'] ?? '', $viewedStories);
            }
            
            // Fetch posts
            $response = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->get('http://localhost:3000/api/v1/post');
            
            // Debug post response
            // dd('Post Response:', $response->json());

            if ($response->successful()) {
                $responseData = $response->json();
             
                $postsData = [];
                if (isset($responseData['data'])) {
                    $postsData = $responseData['data'];
                } elseif (is_array($responseData)) {
                    $postsData = $responseData;
                }
                
               
                $posts = collect($postsData)->map(function ($post) {
                    $postObj = (object) $post;
                    
                    if (isset($post['createdBy'])) {
                        $postObj->createdBy = (object) $post['createdBy'];
                    } elseif (isset($post['author'])) {
                        $postObj->createdBy = (object) $post['author'];
                    } elseif (isset($post['user'])) {
                        $postObj->createdBy = (object) $post['user'];
                    } else {
                        $postObj->createdBy = (object) ['name' => 'Unknown User', 'profile_photo_url' => null];
                    }
                    
                    if (isset($post['likes'])) {
                        $postObj->likes = collect($post['likes']);
                    } else {
                        $postObj->likes = collect([]);
                    }
                    
                    if (isset($post['comments'])) {
                        $postObj->comments = collect($post['comments'])->map(function($comment) {
                            $commentObj = (object) $comment;
                            if (isset($comment['user'])) {
                                $commentObj->user = (object) $comment['user'];
                            } elseif (isset($comment['author'])) {
                                $commentObj->user = (object) $comment['author'];
                            } else {
                                $commentObj->user = (object) ['name' => 'Unknown User'];
                            }
                            return $commentObj;
                        });
                    } else {
                        $postObj->comments = collect([]);   
                    }
                    
                    if (!isset($postObj->image_url) && isset($post['imageUrl'])) {
                        $postObj->image_url = $post['imageUrl'];
                    } elseif (!isset($postObj->image_url) && isset($post['image'])) {
                        $postObj->image_url = $post['image'];
                    }
                    
                    if (!isset($postObj->caption) && isset($post['content'])) {
                        $postObj->caption = $post['content'];
                    }
                    
                    return $postObj;
                });
           
                // dd($posts, $stories);
                return view('explore.beranda', compact('posts', 'stories'));
            } else {
                return view('explore.beranda', ['posts' => collect([]), 'stories' => [], 'error' => 'Gagal mengambil data postingan.']);
            }
        } catch (\Exception $e) {
            return view('explore.beranda', ['posts' => collect([]), 'stories' => [], 'error' => 'Gagal terhubung ke server: ' . $e->getMessage()]);
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
            $token = $request->session()->get('accessToken');
            $response = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->post('http://localhost:3000/api/v1/posts', [
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
    public function show(Request $request, $id)
    {
        try {
            $token = $request->session()->get('accessToken');
            $response = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->get('http://localhost:3000/api/v1/posts/' . $id);

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
    public function destroy(Request $request, $id)
    {
        try {
            $token = $request->session()->get('accessToken');
            $response = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])
            ->delete('http://localhost:3000/api/v1/posts/' . $id);

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
