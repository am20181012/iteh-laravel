<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($user_id)
    {
        $user = User::find($user_id);
        if(is_null($user)){
            return response()->json("User not found!", 404);
        }
        return response()->json(new UserResource($user));
    }
}
