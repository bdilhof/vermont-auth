<?php

namespace VermontDevelopment\Auth\Services;

use VermontDevelopment\Auth\Facades\HrmsFacade as Hrms;
use VermontDevelopment\Auth\Models\User;

class AuthService
{
    public function handleLocalUser($login)
    {
        $hrmsUser = Hrms::getEmployeeByUid($login);
        $user = User::firstOrCreate(['login' => $login], [
            'name' => "{$hrmsUser['firstname']} {$hrmsUser['surname']}",
            'email' => $hrmsUser['email'],
        ]);

        $token = $user->createToken('app-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'store' => session()->get('detected_store', [])
        ];

    }
}
