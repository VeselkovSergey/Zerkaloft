<?php


namespace App\Models\Filters;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FiltersProducts extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'filter_id',
        'product_id',
    ];

    public function AdditionalServices()
    {
        return $this->hasOne(Filters::class, 'id', 'additional_service_id');
    }
}
