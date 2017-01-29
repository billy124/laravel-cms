<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    use Notifiable;
    use EntrustUserTrait; // add this trait to your user model
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Set the user's password with encryption.
     *
     * @param  string  $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = self::encodePassword($value);
    }
    
    /**
     * 
     * @param type $password
     * @return type
     */
    static public function encodePassword($password) {
        return \Hash::make($password);
    }
    
    public function getFullName() {
        return $this->first_name . " " . $this->last_name;
    }
}
