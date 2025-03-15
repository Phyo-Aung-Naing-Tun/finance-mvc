<?php

namespace App\HTTP\Controllers\Auth;

class ForgotPasswordController
{
    public function index()
    {
        return view("auth/forgotPassword");
    }

    public function showResetPasswordPage()
    {
        return view("auth/resetPassword");
    }
}
