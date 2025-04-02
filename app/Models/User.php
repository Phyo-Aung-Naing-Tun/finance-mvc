<?php

namespace App\Models;

use Root\App\Services\Model\Model;

class User extends Model
{
    public $table = "users";

    public $fillables = [
        "name",
        "email",
        "phone",
    ];
}
