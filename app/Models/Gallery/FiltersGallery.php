<?php


namespace App\Models\Gallery;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;



class FiltersGallery extends Model
{
    use HasFactory, Notifiable;

    protected $table = "filters_gallery";

    protected $fillable = [
        'filter_id',
        'gallery_id',
    ];

    public function AdditionalServices()
    {
//        return $this->hasOne(Filters::class, 'id', 'additional_service_id');
    }
}
