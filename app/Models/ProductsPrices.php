<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductsPrices extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'product_id',
        'count',
        'price',
    ];

    public function Product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
