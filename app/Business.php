<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['name', 'description', 'imageUrl', 'address', 'phone', 'website', 'preferredLink'];

    protected $hidden = ['email'];
}
