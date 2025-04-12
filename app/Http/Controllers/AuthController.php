<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Response;

class AuthController extends Controller
{
    public function login(Request $request) {
        if(Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return Response::json(['token' => $token], 200);

        }
        else {
            return Response::json('invalid credentails', 401);
        }
    }
}
