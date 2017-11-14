<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\User;
use App\Http\Resources\User as UserResource;

class RegisterController extends Controller
{
    public function register(UserStoreRequest $request) {
        
        // register user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        
        // login user
        
        return new UserResource($user);
    }
}
