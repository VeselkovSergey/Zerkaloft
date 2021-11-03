<?php


namespace App\Models;


use App\Models\PropertiesCategories\PropertiesCategories;
use App\Models\Relations\RelationsCategoriesAndPropertiesCategories;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Categories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'img',
        'semantic_url',
        'additional_links',
    ];

    public function Products()
    {
        return $this->hasMany(Products::class, 'category_id', 'id');
    }

    public function Properties()
    {
        return $this->belongsToMany(PropertiesCategories::class, 'relations_categories_and_properties_categories', 'category_id', 'properties_categories_id');
    }

    public function RelationsWithProperties()
    {
        return $this->hasMany(RelationsCategoriesAndPropertiesCategories::class, 'category_id', 'id');
    }

    public function Link()
    {
        return route('category', $this->semantic_url);
    }
}
