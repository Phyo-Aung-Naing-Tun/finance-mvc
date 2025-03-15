<?php

namespace App\HTTP\Controllers\Auth;

class ForgotPasswordController
{
    public function index()
    {
        return view("auth/forgotPassword");
    }
}
