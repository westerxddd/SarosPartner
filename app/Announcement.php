<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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
            ->whereNull('deleted_at')
            ->get());
    }

    public function isDuring(){
        if ($this->start_at <= now() && $this->end_at >= now()){
            return true;
        }

        return false;
    }
}
