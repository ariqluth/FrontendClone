<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display explore posts page by fetching from backend API.
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $token = $request->session()->get('accessToken');

        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:3000/api/v1/comment', [
            'post_id' => $request->post_id,
            'body' => $request->body,
        ]);

        if ($response->successful()) {
            return response()->json($response->json(), $response->status());
        } else {
            return response()->json($response->json(), $response->status());
        }
        
    }
}