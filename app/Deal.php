<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    public function getImageSrc(){
        return url('uploads/img/deals/'.$this->image);
    }
}
