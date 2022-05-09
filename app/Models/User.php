<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'createdBy',
        'name',
        'email',
        'password',
        'userRole',
        'contact',
        'is_active',
        'state',
        'city',
        'zipcode',
        'address_line1',
        'address_line2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'okGoogle',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getCanAccessAttribute(){
        return $this->is_active;
    }
    public function getCreatedDateAttribute(){
        return \Carbon\Carbon::parse($this->created_at)->format('D d M Y h:i:s');
    }

    public function createdByInfo(){
        return $this->belongsTo(User::class, 'createdBy', 'id');
    }
}
