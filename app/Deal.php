<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Deal extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getImageSrc(){
        return url('uploads/img/deals/'.$this->image);
    }

    public static function getCurrentDealsCount(){
        return count(DB::table('deals')
            ->where('start_at','<=', now())
            ->where('end_at','>=', now())
            ->whereNull('deleted_at')
            ->get());
    }

    public function getPrefixes(){
        if(strlen($this->extra)>0){
            return explode('%|%', $this->extra);
        }

        return false;
    }

    public function getPrefixesSelect2(){
        if(strlen($this->extra)>0){
            $prefixes = [];
            foreach (explode('%|%', $this->extra) as $prefix){
                $prefixes[$prefix] = $prefix;
            }

            return $prefixes;
        }

        return false;
    }

    public function isDuring(){
        if ($this->start_at <= now() && $this->end_at >= now()){
            return true;
        }

        return false;
    }
}
