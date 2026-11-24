<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    protected $fillable = [
        'platform',
        'version',
        'ip_address',
        'user_agent',
    ];
}
