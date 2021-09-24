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
     * @var string[]
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'phone',
        'gender',
        'deleted_at',
        'deleted_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function CheckContactRegister($cno)
    {
        $query = User::where('phone', $cno)->first();
        return $query;
    }

    public static function CheckContactEdit($cno,$id)
    {
        $query = User::where('id', '!=', $id)->where('phone', '=', $cno)->first();
        return $query;
    }

    public static function CheckEmailRegister($email)
    {
        $query = User::where('email', $email)->first();
        return $query;
    }

    public static function CheckEmailEdit($email,$id)
    {
        $query = User::where('id', '!=', $id)->where('email', '=', $email)->first();
        return $query;
    }
}
