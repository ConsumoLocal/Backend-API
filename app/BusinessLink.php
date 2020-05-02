<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessLink extends Model
{
    protected $fillable = ['business', 'link', 'value'];

    function business() {
        return $this->hasOne(Business::class, 'id', 'business')->withoutGlobalScopes();
    }
}
