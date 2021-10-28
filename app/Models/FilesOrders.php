<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FilesOrders extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'file_id',
        'order_id',
    ];

    public function File()
    {
        return $this->hasOne(Files::class, 'id', 'file_id');
    }
}
