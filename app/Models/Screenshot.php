<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    protected $fillable = [
        'src',
        'caption',
        'hue',
        'sort_order',
    ];
}
