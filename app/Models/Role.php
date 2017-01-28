<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {
    
    public static function getByName($name) {
        return self::where('name', $name)->first();
    }
}
