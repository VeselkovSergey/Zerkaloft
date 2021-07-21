<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Categories extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'img',
    ];

    public function SubCategories()
    {
        return $this->hasMany(Subcategories::class, 'category_id', 'id');
    }
}
