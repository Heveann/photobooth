<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoSession extends Model
{
    protected $guarded = [];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
