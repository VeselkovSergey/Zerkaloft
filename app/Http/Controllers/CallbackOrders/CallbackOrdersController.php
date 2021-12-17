<?php

namespace App\Http\Controllers\CallbackOrders;

use App\Http\Controllers\Controller;
use App\Models\CallbackOrders;

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
        return $newCallbackOrder;
    }

    public function AllCallbackOrders()
    {
        $allCallbackOrders = CallbackOrders::orderBy('id', 'DESC')->get();
        return view('management.callback-orders.index', compact('allCallbackOrders'));
    }
}