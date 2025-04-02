<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'business_name',
        'logo_path',
        'google_review_url',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getReviewPageUrlAttribute()
    {
        return url("/review/{$this->username}");
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating');
    }
}