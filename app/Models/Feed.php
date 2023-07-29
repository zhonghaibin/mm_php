<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasUuids,HasFactory;

    const TYPE_ARTICLE = 0;

    const TYPE_PAGE = 1;
}
