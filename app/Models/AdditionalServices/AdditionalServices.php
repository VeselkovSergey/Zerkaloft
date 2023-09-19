<?php


namespace App\Models\AdditionalServices;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdditionalServices extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'group',
    ];
}
