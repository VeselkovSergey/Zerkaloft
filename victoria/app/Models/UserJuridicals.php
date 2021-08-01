<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserJuridicals extends Model
{


    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'title_org',
        'inn_org',
        'phone_org',
        'surname_worker',
        'name_worker',
        'patronymic_worker',
        'address_juridical_org',
        'address_physical_org',
        'bank_org',
        'bik_bank',
        'payment_account_org',
        'correspondent_account_org',
        'surname_director',
        'name_director',
        'patronymic_director'
    ];

}
