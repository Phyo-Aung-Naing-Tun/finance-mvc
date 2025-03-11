<?php

namespace App\HTTP\Controllers\Auth;

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
}
