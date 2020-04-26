<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['name', 'imagePath'];

    public $timestamps = false;
    // TODO: Upload link images to server
}
