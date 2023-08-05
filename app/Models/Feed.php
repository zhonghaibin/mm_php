<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feed extends Base
{
    use HasUuids,HasFactory;

    protected $fillable = [
        'target_type',
        'target_id',
        'content',
        'html',
    ];

    const TYPE_ARTICLE = 0;

    const TYPE_PAGE = 1;
}
