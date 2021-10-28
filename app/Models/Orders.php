<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orders extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'products',
        'client_name',
        'client_surname',
        'client_phone',
        'client_email',
        'client_comment',
        'type_payment',
        'payment_status',
        'type_delivery',
        'order_status',
        'delivery_address'
    ];

    const DeliveryType = [
        1 => 'Самовывоз',
        2 => 'Доставка',
    ];

    const OrderStatus = [
        1 => 'Заказ только создан',
        2 => 'Заказ в обработке',
        3 => 'Заказ в пути',
        4 => 'Заказ доставлен',
        5 => 'Заказ отменён продавцом',
        6 => 'Заказ отменён покупателем',
    ];

    const PaymentType = [
        1 => 'Оплата при получении',
        2 => 'Онлайн оплата',
    ];

    const PaymentStatus = [
        1 => 'Только создан',
        2 => 'Ожидает оплаты',
        3 => 'Выставлен счёт',
        4 => 'Частично оплачен',
        5 => 'Оплачен',
        6 => 'Отменён',
        7 => 'Возврат',
    ];

    public function DeliveryType()
    {
        return self::DeliveryType[$this->type_delivery];
    }

    public function OrderStatus()
    {
        return self::OrderStatus[$this->order_status];
    }

    public function PaymentType()
    {
        return self::PaymentType[$this->type_payment];
    }

    public function PaymentStatus()
    {
        return self::PaymentStatus[$this->payment_status];
    }
}
