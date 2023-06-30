<?php


namespace App\Services\Mailable;


use App\Models\Orders;
use App\Models\ProductsPrices;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderForClient extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;

        $productsInOrder = json_decode($order->ordered_products);
        $idProductPricesInOrder = [];
        $countProductsInOrder = [];
        foreach ($productsInOrder as $productId => $productPrices) {
            foreach ($productPrices as $productPriceId => $productPrice) {
//                $parseProductPriceId = preg_replace("/[^0-9]/", '', $productPriceId);
                $productPriceId = $productPrice->productPriceId;
                $idProductPricesInOrder[] = $productPriceId;
                $countProductsInOrder[$productPriceId] = $productPrice->count;
            }
        }

        $allProductsInOrder = ProductsPrices::query()
            ->select('*', 'products_prices.id as price_id')
            ->whereIn('products_prices.id', $idProductPricesInOrder)
            ->leftJoin('products', 'products_prices.product_id', '=', 'products.id')
            ->get();

        $products = '';
        foreach ($allProductsInOrder as $key => $product) {
            $category = $product->Product->Category;
            $products .= $key + 1 . '. ' . $category->title . ' ' . $product->title . ' - ' . $product->count . ' - ' . $product->price . ' - ' . $countProductsInOrder[$product->price_id] . ' шт.' . PHP_EOL;
        }

        $paymentType = Orders::PaymentType[$order->type_payment];
        $deliveryType = Orders::DeliveryType[$order->type_delivery];
        $address = $order->delivery_address;

        return $this->view('mail.client-send-email', compact('paymentType', 'deliveryType', 'address', 'products'))->subject(env('APP_NAME'));
    }
}
