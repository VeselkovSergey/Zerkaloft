<?php

namespace App\Http\Controllers\Orders;

use App\Helpers\ResultGenerate;
use App\Http\Controllers\Authorization\AuthorizationController;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController
{
    public function CreateOrder(Request $request)
    {
        $clientAuth = auth()->user();
        $clientID = !$clientAuth ? -1 : auth()->id();
        $clientName = !empty($request->client_name) ? $request->client_name : null;
        $clientSurname = !empty($request->client_surname) ? $request->client_surname : null;
        $clientPhone = !empty($request->client_phone) ? $request->client_phone : null;
        $clientTypePayment = !empty($request->type_payment) ? $request->type_payment : null;
        $clientTypeDelivery = !empty($request->type_delivery) ? $request->type_delivery : null;
        $clientDeliveryAddress = !empty($request->delivery_address) ? $request->delivery_address : null;

        $clientEmail = !empty($request->client_email) ? $request->client_email : null;
        $clientComment = !empty($request->client_comment) ? $request->client_comment : null;
        $orderedProducts = !empty($request->ordered_products) ? json_decode($request->ordered_products) : null;
        $orderedProducts = (array)$orderedProducts;

        $allInfoOrderedProducts = Products::select('id', 'title', 'price')->whereIn('id', array_keys($orderedProducts))->get()->toArray();

        foreach ($allInfoOrderedProducts as $key => $product) {
            $allInfoOrderedProducts[$key]['count'] = $orderedProducts[$product['id']];
        }
        $jsonAllInfoOrderedProducts = json_encode($allInfoOrderedProducts);

        if (!sizeof($orderedProducts)) {
            return ResultGenerate::Error('Ошибка! Нет товаров!');
        }

        if (!$clientName) {
            return ResultGenerate::Error('Ошибка! Заполните имя!');
        }

        if (!$clientSurname) {
            return ResultGenerate::Error('Ошибка! Заполните фамилию!');
        }

        if (!$clientPhone) {
            return ResultGenerate::Error('Ошибка! Заполните номер телефона!');
        }

        if (!$clientTypePayment) {
            return ResultGenerate::Error('Ошибка! Заполните тип оплаты!');
        }

        if (!$clientTypeDelivery) {
            return ResultGenerate::Error('Ошибка! Заполните тип доставки!');
        }

        if (!$clientDeliveryAddress) {
            return ResultGenerate::Error('Ошибка! Заполните адрес доставки!');
        }

        if (!filter_var($clientEmail, FILTER_VALIDATE_EMAIL)) {
            return ResultGenerate::Error('Ошибка! Не верный email!');
        }

        $user = User::query()->where('email', $clientEmail)->first();
        if ($user) {
            $clientID = $user->id;
        } else {
            $newRequestRegistration = new Request();
            $newRequestRegistration['type_user'] = 'physical_user';
            $newRequestRegistration['surname'] = $clientSurname;
            $newRequestRegistration['name'] = $clientName;
            $newRequestRegistration['patronymic'] = '';
            $newRequestRegistration['email'] = $clientEmail;
            $newRequestRegistration['phone'] = $clientPhone;

            $fastRegistrationUserPhysical = new AuthorizationController();
            $resultFastRegistrationUserPhysical = $fastRegistrationUserPhysical->FastRegistration($newRequestRegistration);
            $clientID = $resultFastRegistrationUserPhysical->user_id;
        }

        $fields['user_id'] = $clientID;
        $fields['products'] = $jsonAllInfoOrderedProducts;
        $fields['client_name'] = $clientName;
        $fields['client_surname'] = $clientSurname;
        $fields['client_phone'] = $clientPhone;
        $fields['client_email'] = $clientEmail;
        $fields['client_comment'] = $clientComment;
        $fields['type_payment'] = $clientTypePayment;
        $fields['type_delivery'] = $clientTypeDelivery;
        $fields['delivery_address'] = $clientDeliveryAddress;

        $createdOrder = Orders::create($fields);

        #toDo Отправить письмо на почту об успешном заказе

        return ResultGenerate::Success('Заказ успешно создан!');
    }

    public function OrdersManagementPage()
    {
        $allOrders= Orders::all();
        return view('management.orders.index', [
            'allOrders' => $allOrders
        ]);
    }

    public function DetailOrdersManagementPage(Request $request)
    {
        $orderID = $request->order_id;
        $order = Orders::findOrFail($orderID);
        $productsInOrder = json_decode($order->products);
        $dataProductsInOrder = [];
        foreach ($productsInOrder as $productInOrder) {
            $dataProductsInOrder[$productInOrder->id] = $productInOrder;
        }
        $productsId = [];
        foreach ($productsInOrder as $product) {
            $productsId[] = $product->id;
        }
        $allProductsInOrder = Products::whereIn('id', $productsId)->get();
        return view('management.orders.order', [
            'order' => $order,
            'allProductsInOrder' => $allProductsInOrder,
            'dataProductsInOrder' => $dataProductsInOrder
        ]);
    }

    public function ChangeOrderProperties(Request $request)
    {
        $orderID = $request->order_id;
        $order = Orders::findOrFail($orderID);
        $property = array_key_first($request->all());
        $value = $request->all();

        $order->$property = $value[$property];
        $order->save();
        return ResultGenerate::Success();
    }

    public function ChangeCountProductInOrder(Request $request)
    {
        $orderID = $request->order_id;
        $order = Orders::findOrFail($orderID);

        $productId = (int)$request->product_id;
        $newCount = (int)$request->count;

        $orderProducts = json_decode($order->products);

        foreach ($orderProducts as $key => $product) {
            if ($product->id === $productId) {
                if ($newCount === 0) {
                    unset($orderProducts[$key]);
                } else {
                    $orderProducts[$key]->count = $newCount;
                }
            }
        }

        if (empty($orderProducts)) {
            $order->delete();
            return redirect(route('orders-management-page'));
        } else {
            $order->products = json_encode($orderProducts);
            $order->save();
        }

        return ResultGenerate::Success();
    }
}
