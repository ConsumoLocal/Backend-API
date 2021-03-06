<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Matcher\Not;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed|string The new token
     */
    public function generateToken()
    {
        if (!isset($this->api_token)) {
            $this->api_token = Str::random(60);
            $this->save();
        }
        return $this->api_token;
    }

    public function businesses() {
        return $this-->$this->hasMany(Business::class, 'user_id');
    }

    public function isAdmin($id) {
        $isAdmin = DB::table('users')
            -> select('admin')
            -> where ('id', '=', $id)
            ->get();
        return $isAdmin[0]->admin;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Notifications\ResetPassword($token));
    }
}
