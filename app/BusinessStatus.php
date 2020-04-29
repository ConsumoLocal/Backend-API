<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessStatus extends Model
{
    protected $fillable = ['id', 'value'];

    protected $hidden = ['created_at', 'updated_at'];
}
