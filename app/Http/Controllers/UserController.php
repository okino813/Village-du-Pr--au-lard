<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{


    public function currentUser()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User fetched successfully!',
            ],
            'data' => [
                'user' => $user,
                'isAdmin' => true, // ou tout autre champ
            ],
        ]);
    }


     public function index()
    {
        $users = User::all();

        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'User fetched successfully!',
            ],
            'data' => [
                'user' => $users,
                'isAdmin' => true, // ou tout autre champ
            ],
        ]);
    }
}
