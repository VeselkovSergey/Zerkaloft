<?php


namespace App\Models\Filters;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Filters extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'group',
        'file_id',
    ];
}
