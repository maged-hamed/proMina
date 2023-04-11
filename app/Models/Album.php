<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Traits\HasNameTrait;

class Album extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $table = 'album';
    public $fillable = [
        'name'
    ];
    protected $hidden = ['media'];

    protected $appends = ['images'];


    public function getImagesAttribute()
    {
        $media = $this->getMedia('album', [])->map(function ($image) {
            $result = new \stdClass();
            $result->url = $image->getUrl();
            return $result;
        });
        if ($media) return $media->values();
        else return null;
    }

}
