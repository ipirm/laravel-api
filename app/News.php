<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;
    public $translatable = ['title','description','country','text'];
        protected $casts = [
        'video' => 'array'
    ];
    public function cat()
    {
        return $this->BelongsTo(Cat::class);
    }
    public function sources(){
        return $this->BelongsTo(Sources::class);
    }
}
