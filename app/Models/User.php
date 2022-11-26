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


    public function getUsers($params)
    {
        $users = DB::table('users')
            ->leftjoin('user_addresses', 'users.id', 'user_addresses.user_id')
            ->select(
                'users.id',
                'users.username',
                'email',
                'users.phone',
                'point',
                'is_delete',
                'vip_level',
                'users.created_at',
            )->orderByDesc('users.created_at');
        if ($params['from']) {
            $users->where('orders.created_at', '>=', $params['from']);
        }
        if ($params['to']) {
            $users->where('orders.created_at', '<=', $params['to']);
        }
        if ($params['username']) {
            $users->where('users.username', 'like', "%{$params['username']}%");
        }
        if ($params['phone']) {
            $users->where('users.phone', '=', $params['phone']);
        }
        $users->groupBy('users.id');
        return $users->paginate(10);
    }

    public function updateUser($params)
    {
        $user = DB::table('users')
            ->join('user_addresses', 'users.id', 'user_addresses.user_id')
            ->select(
                'users.id',
                'users.username',
                'email',
                'users.phone',
                'point',
                'is_delete',
                'vip_level',
                'users.created_at',
                'province',
                'district',
                'ward',
                'note as address_note'
            )
            ->where('users.id', $params)
            ->first();
        return $user;
    }

    public function saveUpdateUser($params)
    {
        $resp = DB::table('users')->where('id', $params['id'])->update($params);
        return $resp;
    }

    public function getUserCreate($from = null, $to = null)
    {
        $q = DB::table('users')
            ->select(
                DB::raw("count(id) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as created_at")
            )
            ->whereNotNull('created_at')
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"));

        if ($from) {
            $q->where('created_at', '>=',$from);
        }
        if ($to) {
            $q->where('created_at', '<=', $to);
        }

        return $q->get();;
    }
}
