<?php

namespace VermontDevelopment\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use VermontDevelopment\Auth\Http\Requests\RegisterRequest;
use VermontDevelopment\Auth\Models\User;

class UserController extends Controller
{
    public function create()
    {
        $user = new User();

        return view('auth::register', [
            'user' => $user
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $user = new User();
        $user->login = $request->login;
        $user->password = \Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect()->route('user.create')->with('status', 'Register successful');
        }
    }

}
