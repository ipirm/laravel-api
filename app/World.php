<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class World extends Model
{
   use HasTranslations;
    public $translatable = ['title','text'];
}
