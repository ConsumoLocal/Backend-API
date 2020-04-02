<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['id', 'name', 'description', 'imageUrl', 'address', 'phone', 'website', 'preferredLink'];

    protected $hidden = ['email'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
