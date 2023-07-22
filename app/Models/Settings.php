<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string value
 */
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
        5 => 'Текст для страницы Конфигуратор зеркал',
        6 => 'Дополнительные телефоны',
        7 => 'Номер viber',
        8 => 'Номер whatsap',
        9 => 'Номер telegram',
        10 => 'Почта',
        11 => 'О компании',
        12 => 'Адрес',
        13 => 'Футтер',
        14 => 'Логотип Заголовка',
        15 => 'Задний фон сайта',
        16 => 'Быстрое меню',
        17 => 'Картинки первого блока на главной страницы',
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
        'aboutPageText' => 11,
        'address' => 12,
        'footerText' => 13,
        'headerLogo' => 14,
        'bodyImage' => 15,
        'fastMenu' => 16,
        'firstBlockOnMainPage' => 17,
    ];

    public function TypeSetting()
    {
        return self::Type[$this->type];
    }
}
