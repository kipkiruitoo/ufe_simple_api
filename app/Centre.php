<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_center');
    }
}
