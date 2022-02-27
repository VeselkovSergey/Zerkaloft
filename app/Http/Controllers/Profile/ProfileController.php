<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\ResultGenerate;
use App\Helpers\ValidateFields;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductsPrices;
use App\Models\UserJuridicals;
use App\Models\UserPhysicals;
use Illuminate\Http\Request;

class ProfileController
{

    public function ProfilePage(Request $request)
    {
        dd('ProfilePage');
        $user = auth()->user();
        return view('profile.index', [
           'user' => $user
        ]);
    }

    public function UserOrdersPage(Request $request)
    {
        $userOrders = auth()->user()->Orders;
        return view('profile.orders.all', [
            'userOrders' => $userOrders
        ]);
    }

    public function UserOrderPage(Request $request)
    {
        $orderID = $request->order_id;
        $order = Orders::findOrFail($orderID);
        if ($order->user_id !== auth()->user()->id) {
            return abort('404');
        }

        $productsInOrder = json_decode($order->products);

        $productsPricesId = [];
        $dataProductsInOrder = [];
        foreach ($productsInOrder as $productId => $productPrices) {
            foreach ($productPrices as $productPriceId => $productPrice) {
                $productsPriceId = $productPrice->productPriceId;
                $productsPricesId[] = $productsPriceId;
                $dataProductsInOrder[$productsPriceId] = $productPrice;
            }
        }

        $allProductsInOrder = ProductsPrices::whereIn('id', $productsPricesId)->get();
        return view('profile.orders.order', [
            'order' => $order,
            'allProductsInOrder' => $allProductsInOrder,
            'dataProductsInOrder' => $dataProductsInOrder
        ]);
    }

    public function UserSettingsPage(Request $request)
    {
        $user = auth()->user();
        return view('profile.settings.index', [
           'user' => $user
        ]);
    }

    public function ChangeDetailInformation(Request $request)
    {
        $res = false;

        if (auth()->user()->type_user === 1) {
            $res = $this->ChangeDetailInformationUserPhysical($request);

        } elseif(auth()->user()->type_user === 2) {
            $res = $this->ChangeDetailInformationUserJuridical($request);
        }

        if ($res instanceof UserPhysicals || $res instanceof UserJuridicals) {
            return ResultGenerate::Success('Изменения применены!');
        } else {
            return $res;
        }
    }

    public function ChangeDetailInformationUserPhysical(Request $request)
    {
        $newDetailInformation = $request->all();
        $newDetailInformation = (object)$newDetailInformation;

        if (!$newDetailInformation->surname) {
            return ResultGenerate::Error('Ошибка! Заполните фамилию!');
        }

        if (!$newDetailInformation->name) {
            return ResultGenerate::Error('Ошибка! Заполните имя!');
        }

        if (!$newDetailInformation->patronymic) {
            $newDetailInformation->patronymic = '';
        }

        if (!$newDetailInformation->phone) {
            return ResultGenerate::Error('Ошибка! Заполните номер телефона!');
        }

        $newDetailInformation->phone = preg_replace("/[^0-9]/", '', $newDetailInformation->phone);

        $detailInfo = UserPhysicals::where('user_id', auth()->user()->id)->firstOrFail();
        $detailInfo->update((array)$newDetailInformation);
        return $detailInfo;
    }

    public function ChangeDetailInformationUserJuridical(Request $request)
    {
        $newDetailInformation = $request->all();

        $valid = ValidateFields::NullAndIsset($newDetailInformation, [
            'title_org',
            'inn_org',
            'email_org',
            'phone_org',
            'surname_worker',
            'name_worker',
        ]);

        if (!$valid) {
            return 'Заполнены не все обязательные поля!';
        }

        $detailInfo = UserJuridicals::where('user_id', auth()->user()->id)->firstOrFail();
        $detailInfo->update($newDetailInformation);
        return $detailInfo;
    }

}
