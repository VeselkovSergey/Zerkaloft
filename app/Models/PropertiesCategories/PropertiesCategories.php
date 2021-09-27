<?php


namespace App\Models\PropertiesCategories;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PropertiesCategories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
    ];

    public function Values()
    {
        return $this->hasMany(PropertiesCategoriesValues::class, 'properties_categories_id', 'id');
    }
}
