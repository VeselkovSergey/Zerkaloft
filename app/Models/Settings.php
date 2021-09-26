<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'value',
    ];

    const Type = [
        1 => 'Номер телефона',
        2 => 'Картинки карусели',
    ];

    public function TypeSetting()
    {
        return self::Type[$this->type];
    }
}
