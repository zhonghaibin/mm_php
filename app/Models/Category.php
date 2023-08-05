<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Base
{
    use HasUuids,HasFactory;

    protected $fillable = ['name', 'flag', 'parent_id', 'keywords', 'description', 'sort'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function getTreeIndex($id = 0, $deep = 0)
    {
        static $tempArr = [];
        $data = $this->query()->where('parent_id', $id)->orderBy('sort', 'asc')
            ->get();
        foreach ($data as $k => $v) {
            $v->deep = $deep;
            $v->name = str_repeat('&nbsp;&nbsp;', $v->deep * 2).'|--'.$v->name;
            $tempArr[] = $v;
            $this->getTreeIndex($v->id, $deep + 1);
        }

        return $tempArr;
    }
}
