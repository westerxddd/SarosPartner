<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Announcement extends Model
{
    public function getImageSrc(){
        if (isset($this->image)){
            return url('uploads/img/announcements/'.$this->image);
        }

        return false;
    }

    public static function getCurrentAnnouncementsCount(){
        return count(DB::table('announcements')
            ->where('start_at','<=', now())
            ->where('end_at','>=', now())
            ->get());
    }
}
