<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $guarded = [];

    public function teams() {
        return $this->hasMany(Team::class);
    }

    public function getLogoAttribute($value) {
        return $value? asset('storage/' . $value): null;
    }
}
