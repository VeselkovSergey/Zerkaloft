<?php


namespace App\Helpers;


class Utils
{
    public static function isFavourite(int $productId): bool
    {
        $favouriteProducts = session()->get("favouriteProducts") ?? [];
        return !(array_search($productId, $favouriteProducts) === false);
    }
}
