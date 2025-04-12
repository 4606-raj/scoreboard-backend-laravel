<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }
}
