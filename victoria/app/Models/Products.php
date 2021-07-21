<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Products extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'subcategory_id',
        'img',
        'semantic_url',
    ];

    public function Subcategory()
    {
        return $this->hasOne(Categories::class, 'id', 'subcategory_id');
    }
}
