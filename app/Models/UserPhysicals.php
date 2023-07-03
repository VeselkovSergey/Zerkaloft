<?php


namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class UserPhysicals extends Model
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'surname',
        'name',
        'patronymic',
        'phone',
    ];

}
