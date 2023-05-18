<?php


namespace App\Models;


use App\Models\AdditionalServices\AdditionalProductServices;
use App\Models\AdditionalServices\AdditionalServices;
use App\Models\PropertiesCategories\PropertiesCategoriesValues;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin Builder
 * @property AdditionalProductServices AdditionalServicesPrice
 * @property AdditionalServices AdditionalServices
 * @property Categories Category
 * @property ProductsPrices Prices
 */
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
        'show_add_more',
        'isPopular',
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

    public function FirstImgUrl()
    {
        return route('files', unserialize($this->img)[0]);
    }

    public function AdditionalServices()
    {
        return $this->belongsToMany(AdditionalServices::class, 'additional_product_services', 'product_id', 'additional_service_id');
    }

    public function AdditionalServicesPrice()
    {
        return $this->hasMany(AdditionalProductServices::class, 'product_id', 'id');
    }

    public function Properties()
    {
        $propertiesIds = explode("-", $this->modification_id);
        $properties = PropertiesCategoriesValues::whereIn("id", $propertiesIds)->get();
        return $properties;
    }
}
