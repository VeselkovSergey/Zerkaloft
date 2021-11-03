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
    ];

    const TypeByWords = [
        'mainPhone' => 1,
        'carouselImage' => 2,
        'calculatorPageText' => 3,
        'onlineOrderPageText' => 4,
        'fastOrderPageText' => 5,
    ];

    public function TypeSetting()
    {
        return self::Type[$this->type];
    }
}
