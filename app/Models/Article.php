<?php

namespace App\Models;

use App\Helpers\Extensions\Tool;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Base
{
    use SoftDeletes,HasUuids,HasFactory;

    protected $fillable = ['category_id', 'title', 'author', 'keywords', 'description', 'tag_ids', 'content', 'status', 'is_top'];

    protected $appends = ['top_tag'];

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
        return ArticleTagRel::query()->where('article_id', $this->attributes['id'])
            ->pluck('article_tag_id')->toArray();
    }

    /**
     * @return mixed
     */
    public function getFeedUpdatedAtAttribute()
    {
        return Feed::query()->where([
            'target_type' => Feed::TYPE_ARTICLE,
            'target_id' => $this->attributes['id'],
        ])->value('updated_at');
    }

    /**
     * 获取置顶标签
     *
     * @return string
     */
    public function getTopTagAttribute()
    {
        $route = route('article_top', $this->attributes['id']);

        return $this->attributes['is_top'] === self::IS_TOP ? '<a href="'.$route
            .'" class="btn btn-sm btn-info btn-flat">取消置顶</a>'
            : '<a href="'.$route
            .'" class="btn btn-sm btn-danger btn-flat">置顶</a>';
    }

    /**
     * 过滤描述中的换行。
     */
    public function getDescriptionAttribute(string $value): string
    {
        return str_replace(["\r", "\n", "\r\n"], '', $value);
    }

    /**
     * 添加文章
     *
     * @param  array  $data
     * @return bool|mixed
     */
    public function storeData($data)
    {
        $tag_ids = $data['tag_ids'];
        $feed['content'] = $data['content'];
        $feed['html'] = Tool::markdown2Html($data['content']);
        // 如果没有描述;则截取文章内容的前200字作为描述
        if (empty($data['description'])) {
            $description = preg_replace([
                '/[~*>#-]*/',
                '/!?\[.*\]\(.*\)/',
                '/\[.*\]/',
            ], '', $data['content']);
            $data['description'] = Tool::subStr($description, 0, 150, true);
        }
        unset($data['tag_ids']);
        unset($data['content']);
        //添加数据
        $result = parent::storeData($data);
        if ($result) {
            // 给文章添加标签
            $articleTagRel = new ArticleTagRel();
            $articleTagRel->addTagIds($result, $tag_ids);
            // 保存feed
            Feed::query()->create([
                'target_type' => Feed::TYPE_ARTICLE,
                'target_id' => $result,
                'content' => $feed['content'],
                'html' => $feed['html'],
            ]);
            Tool::syncRank($result);

            return $result;
        }

        return false;
    }

    /**
     * @param  int  $id
     * @param  array  $data
     * @return bool
     */
    public function updateData($id, $data)
    {
        $tag_ids = $data['tag_ids'];
        $feed['content'] = $data['content'];
        $feed['html'] = Tool::markdown2Html($data['content']);
        // 如果没有描述;则截取文章内容的前150字作为描述
        if (empty($data['description'])) {
            $description = preg_replace([
                '/[~*>#-]*/',
                '/!?\[.*\]\(.*\)/',
                '/\[.*\]/',
            ], '', $data['content']);
            $data['description'] = Tool::subStr($description, 0, 150, true);
        }
        unset($data['tag_ids'], $data['content']);
        $result = parent::updateData(['id' => $id], $data);
        if ($result) {
            $articleTagRel = new ArticleTagRel();
            $articleTagRel->addTagIds($id, $tag_ids);
            // 保存feed
            Feed::query()->where([
                ['target_type', '=', Feed::TYPE_ARTICLE],
                ['target_id', '=', $id],
            ])->update([
                'content' => $feed['content'],
                'html' => $feed['html'],
            ]);

            return $result;
        }

        return false;
    }
}
