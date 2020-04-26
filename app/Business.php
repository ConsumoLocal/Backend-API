<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'imageUrl',
        'address',
        'email',
        'preferredLink',
        'status',
        'latitude',
        'longitude',
        'city'
    ];

    protected $hidden = ['email'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city');
    }

    public function status() {
        echo 'HERE BABY';
        echo $this->hasOne(BusinessStatus::class, 'status');
        return $this->hasOne(BusinessStatus::class, 'status');
    }
}
