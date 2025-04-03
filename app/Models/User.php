<?php

namespace App\Models;

use Root\App\Services\Model\Model;

class User extends Model
{

    public $fillables = [
        "name",
        "email",
        "phones",
        "password",
    ];
}
