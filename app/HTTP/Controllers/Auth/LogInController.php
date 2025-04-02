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
        return "User login";
    }

    public function store()
    {
        User::create(["name" => "Mg Mg"]);
    }
}
