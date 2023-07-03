<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type_user',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const TypeUser = [
        1 => 'Физическое лицо',
        2 => 'Юридическое лицо'
    ];

    const RoleName = [
        99 => 'Администратор',
        10 => 'Менеджер',
        1 => 'Пользователь'
    ];

    public function TypeUser()
    {
        return self::TypeUser[$this->type_user];
    }

    public static function PasswordGenerate($length = 12): string
    {

        if(!is_int($length)) {
            $length = 12;
        }

        if($length < 1) {
            $length = 12;
        }

        $pass = '';
        $possible_characters = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789!*#^$';

        while($length--) {
            $pass .= $possible_characters[rand(0 , mb_strlen($possible_characters)-1)];
        }

        return $pass;
    }

    public function DetailedInformation()
    {
        if ($this->type_user === 1) {
            return $this->hasOne(UserPhysicals::class, 'user_id', 'id');
        } else {
            return $this->hasOne(UserJuridicals::class, 'user_id', 'id');
        }
    }

    public function Name()
    {
        if ($this->type_user === 1) {
            return UserPhysicals::select('name')->where('user_id', $this->id)->first()->name;
        } else {
            return UserJuridicals::select('name_worker')->where('user_id', $this->id)->first()->name_worker;
        }
    }

    public function Surname()
    {
        if ($this->type_user === 1) {
            return UserPhysicals::select('surname')->where('user_id', $this->id)->first()->surname;
        } else {
            return UserJuridicals::select('surname_worker')->where('user_id', $this->id)->first()->surname_worker;
        }
    }

    public function Phone()
    {
        if ($this->type_user === 1) {
            return UserPhysicals::select('phone')->where('user_id', $this->id)->first()->phone;
        } else {
            return UserJuridicals::select('phone_org')->where('user_id', $this->id)->first()->phone_org;
        }
    }

    public function Orders()
    {
        return $this->hasMany(Orders::class, 'user_id', 'id');
    }
}
