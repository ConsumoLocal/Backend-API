<?php

namespace App;

use App\Scopes\ActiveBusinessScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class Business extends Model
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'id',
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
        static::bootSoftDeletes();
    }

    protected $hidden = ['deleted_at', 'pivot'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
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

    public function links() {
        return $this->hasMany(BusinessLink::class, 'business');

    }

    /**
     * Send business welcome email.
     *
     * @return void
     */
    public function sendBusinessWelcomeEmail()
    {
        $this->notify(new Notifications\NewBusiness($this->name));
    }

    /**
     * Send business notification when it turns active.
     *
     * @return void
     */
    public function sendBusinessActiveEmail()
    {
        $this->notify(new Notifications\BusinessActive());
    }
}
