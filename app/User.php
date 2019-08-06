<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'level', 'email', 'password', 'address', 'phone', 'address', 'provider', 'provider_id',
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

    public function agency()
    {
        return $this->hasMany('App\Agency');
    }

    public function getDataById($id)
    {
        return $this->find($id)->toArray();
    }

    public function editDataById($id, $data)
    {
        $this->find($id)
             ->update(['name' => $data[0], 'phone' => $data[1], 'address' => $data[2]]);
    }

    public function editPassword($id, $new_pass)
    {
        $this->where('id', $id)->update(['password' => $new_pass]);
    }

    public function createBuyer($data)
    {
        $this->create([
            'name' => $data['name'],
            'level' => 0,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);
    }

}
