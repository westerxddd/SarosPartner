<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deal extends Model
{
    public function getImageSrc(){
        return url('uploads/img/deals/'.$this->image);
    }

    public static function getCurrentDealsCount(){
        return count(DB::table('deals')->where('start_at','<=', now())
            ->where('end_at','>=', now())
            ->get());
    }
}
