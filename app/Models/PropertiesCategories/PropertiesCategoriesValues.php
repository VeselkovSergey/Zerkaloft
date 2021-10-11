<?php


namespace App\Models\PropertiesCategories;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PropertiesCategoriesValues extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'properties_categories_id',
        'value',
    ];

    public function Title()
    {
        return $this->hasOne(PropertiesCategories::class, 'id', 'properties_categories_id');
    }
}
