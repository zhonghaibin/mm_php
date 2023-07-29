<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes,HasUuids,HasFactory;

    const PUBLISHED = 1;

    const UNPUBLISHED = 0;

    const FORBID_COMMENT = 0;

    const IS_TOP = 1;

    const IS_NORMAL = 0;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ArticleTag::class, ArticleTagRel::class);
    }

    public function getFeedAttribute()
    {
        return Feed::query()->where([
            'target_type' => Feed::TYPE_ARTICLE,
            'target_id' => $this->attributes['id'],
        ])->first();
    }

    public function getTagIdsAttribute(): array
    {
        return ArticleTag::query()->where('article_id', $this->attributes['id'])
            ->pluck('tag_id')->toArray();
    }

    /**
     * 过滤描述中的换行。
     */
    public function getDescriptionAttribute(string $value): string
    {
        return str_replace(["\r", "\n", "\r\n"], '', $value);
    }
}
