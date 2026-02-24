<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = ['name', 'country_id', 'image', 'status'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
