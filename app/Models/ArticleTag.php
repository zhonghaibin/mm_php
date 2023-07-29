<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticleTag extends Model
{
    use HasUuids,HasFactory;

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, ArticleTagRel::class);
    }
}
