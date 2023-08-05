<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ArticleTag extends Base
{
    use HasUuids,HasFactory;

    protected $fillable = ['name', 'flag'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, ArticleTagRel::class);
    }
}
