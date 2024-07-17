<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterEmpresa extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:455',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo_user' => 1,
            'estado' => 1,
            'fecha_registro' => now(),
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
          'user' =>$user,
          'access_token'=>$token,
          'token_type' => 'bearer',
          'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
        // return $request->all();
    }
}
