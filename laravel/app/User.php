<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'driver_license', 'phone_number', 'type', 'passport', 'address', 'company_code', 'company_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() : bool
    {
        return ($this->role === 'admin');
    }
    public function encodeLastCharOfString($string, $chr = 1){
        $txt = "";

        if($chr > 1){
            for ($i = 1; $i <= $chr; $i++) {
                $txt .= "*";
            }
        } else {
            $txt .= "*";
        }

        return substr($string, 0, -$chr).$txt;
    }
}
