<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests\UserStoreRequest;
use App\User;

class RegisterController extends Controller
{
    public function register(UserStoreRequest $request) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->toArray();
    }
}
