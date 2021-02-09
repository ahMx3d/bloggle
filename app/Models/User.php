<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use
        Notifiable,
        EntrustUserWithPermissionsTrait;    // Entrust Permissions Package.

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        // from routes/channels.php
        return 'App.User.'.$this->id;
    }

    /**
     * Register User Observer
     *
     * @return void
     */
    protected static function boot(){
		parent::boot();
		self::observe(UserObserver::class);
	}

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to order users DESC.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderDesc($query)
    {
        return $query->orderBy(
            'id',
            'DESC'
        );
    }

    /**
     * The User Post Relationship
     * Each user has many posts.
     *
     * @return object
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The User Comment Relationship
     * Each user has many comments.
     *
     * @return object
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
