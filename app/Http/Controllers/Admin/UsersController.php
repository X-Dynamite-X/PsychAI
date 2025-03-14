<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User};

class UsersController extends Controller
{
    //
    public function index()
    {
        $users =  User::all();
        //compact('users')
        return view('Admin.users', data: [
            'users' => $users,
        ]);
    }
    public function show(User $user)
    {
        // dd($user);
        $userModel = view('model.users.edit', ['user' => $user])->render();
        return response()->json([
            'userModel' =>$userModel
        ])->header('Cache-Control', 'public, max-age=3600');
    }
}
