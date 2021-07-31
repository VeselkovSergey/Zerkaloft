<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subcategories extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'category_id',
        'img',
        'semantic_url',
    ];

    public function Category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function Products()
    {
        return $this->hasMany(Products::class, 'subcategory_id', 'id');
    }
}
