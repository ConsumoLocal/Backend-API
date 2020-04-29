<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['name', 'imagePath'];

    public $timestamps = false;

    public function dataType() {
        return $this->hasOne(LinkDataType::class, 'id', 'dataType');
    }
}
