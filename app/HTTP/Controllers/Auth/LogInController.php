<?php

namespace App\HTTP\Controllers\Auth;

use App\Models\User;

class LogInController
{


    public function index()
    {
        return view("auth/login");
    }

    public function login()
    {
        $user = User::where("email", "emai")->get();
        dump($user);
        return "User login";
    }

    public function store()
    {
        $user = User::create([
            "name" => "Mg Mg",
            "email" => "email",
            "phones" => json_encode(['99999999', '4444444']),
            "password" => "password",
        ]);
    }
}
