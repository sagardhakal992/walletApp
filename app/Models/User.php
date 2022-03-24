<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number'
    ];

    protected $appends=[
        "total_amount"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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

    public function sendtransactions()
    {
        return $this->hasMany(Transactions::class,'sender_id');
    }

    public function recievedTranscactions()
    {
        return $this->hasMany(Transactions::class,'receiver_id');
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->userInfo->amount;
    }

    protected $dispatchesEvents=[
        'created'=>UserCreated::class
    ];
}
