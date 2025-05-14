<?php

namespace App\HTTP\Controllers\User;

use App\Models\User;

class UserController
{
    public function index()
    {
        $user = User::all();

        echo json_encode(["a", "b", "c"]);
    }
}
