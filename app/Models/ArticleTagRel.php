<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ArticleTagRel extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $table = 'article_tags_rel';
}
