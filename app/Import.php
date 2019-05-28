<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    public function clients(){
        return $this->hasMany('App\Client');
    }

    public function articles(){
        return $this->hasMany('App\ClientArticles');
    }
}
