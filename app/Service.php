<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function mda()
    {
        return $this->belongsTo(MDA::class, 'mda_id');
    }
}
