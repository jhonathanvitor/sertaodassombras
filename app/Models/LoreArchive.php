<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoreArchive extends Model
{
    protected $fillable = [
        'code',
        'icon',
        'title',
        'summary',
        'fragment',
        'offset',
        'sort_order',
    ];

    protected $casts = [
        'offset' => 'boolean',
    ];
}
