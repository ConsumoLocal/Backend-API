<?php

namespace App;

use App\Scopes\ActiveBusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

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

    public static function booted()
    {
        static::addGlobalScope(new ActiveBusinessScope());
    }

    protected $hidden = ['email', 'deleted_at'];

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
