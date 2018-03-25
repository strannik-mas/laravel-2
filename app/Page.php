<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //12 урок
    protected $fillable = ['name', 'alias', 'text', 'images'];
}
