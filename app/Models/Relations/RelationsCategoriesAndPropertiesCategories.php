<?php


namespace App\Models\Relations;


use App\Models\Categories;
use App\Models\PropertiesCategories\PropertiesCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RelationsCategoriesAndPropertiesCategories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'category_id',
        'properties_categories_id',
    ];

    public function Category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function PropertiesCategories()
    {
        return $this->hasOne(PropertiesCategories::class, 'id', 'properties_categories_id');
    }
}
