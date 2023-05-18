<?php

namespace App\Http\Controllers\CallbackOrders;

use App\Http\Controllers\Controller;
use App\Models\CallbackOrders;
use App\Services\Telegram\Telegram;

class CallbackOrdersController extends Controller
{
    public function CreateCallbackOrderRequest()
    {
        $phone = request()->post('phone');
        $name = request()->post('name');
        $comments = request()->post('comments');
        return self::CreateCallbackOrder($phone, $name, $comments);
    }

    public function CreateCallbackOrder($phone, $name, $comments = '')
    {
        $newCallbackOrder = CallbackOrders::create([
            'name' => $name,
            'phone' => $phone,
            'comments' => $comments
        ]);

        $message = '<i>Новый запрос.</i>'.PHP_EOL.'<a href="'.route("all-callback-orders").'">Перейти к запросам</a>';

        $telegram = new Telegram();
        $telegram->sendMessage($message, env('TELEGRAM_ORDER_GROUP'));
        return $newCallbackOrder;
    }

    public function AllCallbackOrders()
    {
        $allCallbackOrders = CallbackOrders::orderBy('id', 'DESC')->get();
        return view('management.callback-orders.index', compact('allCallbackOrders'));
    }
}
