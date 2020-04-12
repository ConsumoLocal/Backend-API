<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessTag extends Model
{
    protected $fillable = ['id', 'business', 'tag'];
}
