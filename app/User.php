<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * initials
     * Make initials form user name
     * 
     * @return string 
     */
    public function initials(): string
    {
        $names = explode(" ", $this->name);
        $initials = "";
        for ($i = 0; $i < 2 || $i < count($names); $i++) {
            $initials .= strtoupper($names[0]);
        }
        return $initials;
    }
}
