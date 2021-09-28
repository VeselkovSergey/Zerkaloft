<?php


namespace App\Models\Relations;


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
}
