<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MDA extends Model
{

    public function services()
    {
        return $this->hasMany(Service::class, 'mda_id');
    }


    protected $table = 'mdas';
}
