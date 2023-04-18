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
        return self::CreateCallbackOrder($phone, $name);
    }

    public function CreateCallbackOrder($phone, $name)
    {
        $newCallbackOrder = CallbackOrders::create([
            'name' => $name,
            'phone' => $phone
        ]);

        $message = '<i>Новый запрос.</i><a href="'.route("all-callback-orders").'">к запросам</a>' . PHP_EOL;

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
