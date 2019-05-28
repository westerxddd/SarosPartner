<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function client(){
        return $this->hasOne('App\Client');
    }

    public function registrationURL(){
        return route('users.register', ['token'=>$this->token]);
    }

    public function getPoints(){
        return $this->client->getPoints();
    }

    public function isAdmin(){
        if ($this->admin){
            return true;
        }
        return false;
    }

    public function hasArticles(){
        if(isset($this->client->articles)){
            return true;
        }

        return false;
    }
}
