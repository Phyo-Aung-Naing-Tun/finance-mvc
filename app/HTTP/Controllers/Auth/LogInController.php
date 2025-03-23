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
        dd("here");
        return "User login";
    }

    public function store()
    {
        User::create(["hello"]);
    }
}
