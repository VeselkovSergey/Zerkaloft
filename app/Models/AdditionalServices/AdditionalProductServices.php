<?php


namespace App\Models\AdditionalServices;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdditionalProductServices extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'additional_service_id',
        'product_id',
        'price',
    ];
}
