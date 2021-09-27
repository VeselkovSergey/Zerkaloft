<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Products extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'subcategory_id',
        'img',
        'semantic_url',
        'price',
        'description',
    ];

    public function Subcategory()
    {
        return $this->hasOne(Subcategories::class, 'id', 'subcategory_id');
    }

    public function Prices()
    {
        return $this->hasMany(ProductsPrices::class, 'product_id', 'id');
    }
}
