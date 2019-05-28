<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function articles(){
        return $this->hasMany('App\ClientArticles');
    }

    public function points(){
        return $this->hasOne('App\Point');
    }

    public function addPoints($points){
        if(count($this->points) < 1){
            $points = new Point;

            $points->client_id = $this->id;
            $points->amount = 0;
            $points->save();
        }

        $this->points->amount += $points;
        $this->points->save();
    }

    public function getPoints(){
        return floor($this->points->amount);
    }
}
