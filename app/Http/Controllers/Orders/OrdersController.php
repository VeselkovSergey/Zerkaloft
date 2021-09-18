<?php

namespace App\Http\Controllers\Orders;

use App\Helpers\ResultGenerate;
use App\Http\Controllers\Authorization\AuthorizationController;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductsPrices;
use App\Models\User;
use App\Services\Telegram\Telegram;
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

        $jsonAllInfoOrderedProducts = json_encode($orderedProducts, JSON_UNESCAPED_UNICODE);

        if (!$orderedProducts) {
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

        $this->SendTelegram($request);

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

    private function SendTelegram(Request $request) {

        $order = $request;

        $productsInOrder = json_decode($order->ordered_products);
        $idProductPricesInOrder = [];
        $countProductsInOrder = [];
        foreach ($productsInOrder as $productId => $productPrices) {
            foreach ($productPrices as $productPriceId => $productPrice) {
                $parseProductPriceId = preg_replace("/[^0-9]/", '', $productPriceId);
                $idProductPricesInOrder[] = $parseProductPriceId;
                $countProductsInOrder[$parseProductPriceId] = $productPrice->count;
            }
        }

        $allProductsInOrder = ProductsPrices::query()
            ->select('*', 'products_prices.id as price_id')
            ->whereIn('products_prices.id', $idProductPricesInOrder)
            ->leftJoin('products', 'products_prices.product_id', '=', 'products.id')
            ->get();
        $products = '';
        foreach ($allProductsInOrder as $key => $product) {
            $products .= $key + 1 . '. ' .$product->title . ' - ' . $product->count . ' - ' . $product->price . ' - ' . $countProductsInOrder[$product->price_id] . ' шт.' . PHP_EOL;
        }

        $message = '<b>Заказчик:</b>' . PHP_EOL;
        $message .= '<i>Имя:</i> ' . $order->client_name . PHP_EOL;
        $message .= '<i>Фамилия:</i> ' . $order->client_surname . PHP_EOL;
        $message .= '<i>Телефон:</i> ' . $order->client_phone . PHP_EOL;
        $message .= '<i>Email:</i> ' . $order->client_email . PHP_EOL;
        $message .= '<i>Оплата:</i> ' . Orders::PaymentType[$order->type_payment] . PHP_EOL;
        $message .= '<i>Доставка:</i> ' . Orders::DeliveryType[$order->type_delivery] . PHP_EOL;
        $message .= '<i>Адрес:</i> ' . $order->delivery_address . PHP_EOL;
        $message .= '<i>Комментарий:</i> ' . $order->client_comment . PHP_EOL;
        $message .= PHP_EOL;
        $message .= '<b>Заказ:</b>' . PHP_EOL;
        $message .= $products;

        $telegram = new Telegram();
        $telegram->sendMessage($message, '267236435');
    }
}
