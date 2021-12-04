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
        3 => 'Текст для страницы калькулятора',
        4 => 'Текст для страницы онлайн заказа',
        5 => 'Текст для страницы быстрое оформление',
        6 => 'Дополнительные телефоны',
        7 => 'Номер viber',
        8 => 'Номер whatsap',
        9 => 'Номер telegram',
        10 => 'Почта',
    ];

    const TypeByWords = [
        'mainPhone' => 1,
        'carouselImage' => 2,
        'calculatorPageText' => 3,
        'onlineOrderPageText' => 4,
        'fastOrderPageText' => 5,
        'additionalPhones' => 6,
        'viberPhone' => 7,
        'whatsappPhone' => 8,
        'telegramPhone' => 9,
        'mail' => 10,
    ];

    public function TypeSetting()
    {
        return self::Type[$this->type];
    }
}
