<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [

        'title',
        'content',
        'short_text',
        'image_path',
        'view_count',
        'is_published',
        'author_id',
    ];

//    JOIN
//Получение пользователя привязанного к статье
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id')->first();
    }

    public function getImageUrlAttribute()
    {
        // http://127.0.0.8000/ - url
        // storage::url ->>> /storage/public/images/dwdfewfew.fewrfe.png
        return url(Storage::url($this->image_path));
    }
}
