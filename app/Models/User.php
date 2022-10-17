<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // cái này để làm màu nha bro
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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


    public function getUsers()
    {
        $users = DB::table('users')
            ->select(
                'id',
                'username',
                'email',
                'phone',
                'point',
                'is_delete',
                'vip_level',
                'created_at'
            )
            ->paginate(10);
        return $users;
    }

    public function updateUser($params)
    {
        $user = DB::table('users')->find($params);
        return $user;
    }

    public function saveUpdateUser($params)
    {
        $resp = DB::table('users')->where('id', '=', $params['id'])->update($params);
        return $resp;
    }
}
