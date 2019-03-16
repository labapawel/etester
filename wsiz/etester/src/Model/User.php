<?php

namespace wsiz\etester\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\User as Userx;

class User extends Userx
{

    public $table = 'users';


    public function setPasswordAttribute($param) {
        if(!empty($param))
            $this->attributes['password']=\Hash::make($param);
    }
    
}
