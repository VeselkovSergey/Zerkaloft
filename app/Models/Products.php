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
        'category_id',
        'modification_id',
        'img',
        'semantic_url',
        'price',
        'description',
        'search_words',
        'active',
        'not_only_calculator',
        'show_main_page',
    ];

    public function Category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function Prices()
    {
        return $this->hasMany(ProductsPrices::class, 'product_id', 'id');
    }

    public function Link()
    {
        return route('product', [$this->Category->semantic_url, $this->semantic_url]);
    }
}
