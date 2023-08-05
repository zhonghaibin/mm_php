<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ArticleTagRel extends Base
{
    use HasUuids;

    public $timestamps = false;

    protected $table = 'article_tags_rel';

    public function addTagIds($article_id, $tag_ids)
    {
        // 先删除此文章下的所有标签
        $this->query()->where('article_id', $article_id)->forceDelete();
        // 组合批量插入的数据
        $data = [];
        foreach ($tag_ids as $k => $v) {
            $data[] = [
                'article_id' => $article_id,
                'article_tag_id' => $v,
            ];
        }
        $this->query()->insert($data);
    }
}
