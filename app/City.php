<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['id', 'name', 'latitude', 'longitude'];

    public $timestamps = false;

    public function businesses() {
        return $this->hasMany(Business::class, 'id');
    }
}
