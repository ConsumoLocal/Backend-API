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

    protected $hidden = ['deleted_at', 'pivot'];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function city() {
        return $this->hasOne(City::class, 'id', 'city');
    }

    public function status() {
        return $this->hasOne(BusinessStatus::class, 'id', 'status');
    }

    public function categories() {
        return $this->belongsToMany(Category::class,
            'business_categories',
            'business',
            'category');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class,
        'business_tags',
        'business',
        'tag');
    }
}
