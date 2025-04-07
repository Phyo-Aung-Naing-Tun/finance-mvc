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
        $user = User::whereBetween("id", 1, 4)->latest()->first();
        dump($user);
        return "User login";
    }

    public function store()
    {
        $user = User::create([
            "name" => "aung Mg Aung",
            "email" => "email",
            "phones" => json_encode(['99999999', '4444444']),
            "password" => "password",
        ]);
    }
}
