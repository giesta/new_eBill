<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasApiTokens;
}
