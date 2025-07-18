<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller {
    public function index() {
        return view('auth.reset-password');
    }

    public function reset(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            $response = Http::post(env('API_BASE_URL') . '/api/v1/user/forgot-password', [
                'email' => $request->email,
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
        }   //
    }

}