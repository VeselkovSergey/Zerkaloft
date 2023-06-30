<?php


namespace App\Models\Gallery;


use App\Models\Filters\Filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Gallery extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'gallery';

    protected $fillable = [
        'description',
        'tech_properties',
        'img',
    ];

    public function filters()
    {
        return $this->hasManyThrough(Filters::class, FiltersGallery::class, 'gallery_id', 'id', 'id', 'filter_id');
    }

    public function link()
    {
        return route('gallery-item', $this->id);
    }

    public function FirstImgUrl()
    {
        return route('files', unserialize($this->img)[0]);
    }
}
