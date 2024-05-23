<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function league()
    {
        return $this->belongsTo('App\League');
    }
}
