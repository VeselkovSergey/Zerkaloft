<?php


namespace App\Models\PropertiesCategories;


use App\Models\Categories;
use App\Models\Relations\RelationsCategoriesAndPropertiesCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PropertiesCategories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'sequence',
        'is_professional',
    ];

    public function Values()
    {
        return $this->hasMany(PropertiesCategoriesValues::class, 'properties_categories_id', 'id');
    }

    public function RelationCategories()
    {
        return $this->hasMany(RelationsCategoriesAndPropertiesCategories::class, 'properties_categories_id', 'id');
    }
}
