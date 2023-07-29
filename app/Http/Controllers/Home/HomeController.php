<?php

namespace App\Http\Controllers\Home;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\ArticleTagRel;
use App\Models\Category;
use App\Models\Nav;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $nav_list = Tool::getRecursiveData(Nav::query()
            ->where('status', Nav::STATUS_DISPLAY)
            ->orderBy('sort')
            ->get());
        $category_list = Category::query()->select('id', 'name')
            ->where('parent_id', 0)
            ->orderBy('sort')
            ->get();
        $article_tag_list = ArticleTag::query()->select('id', 'name')
            ->orderBy('created_at', 'desc')
            ->get();
        $top_article_list = Article::query()->select('id', 'title')
            ->orderBy('rank', 'desc')
            ->limit(10)
            ->inRandomOrder()
            ->get();
        $assign = compact('nav_list', 'category_list', 'top_article_list', 'article_tag_list');
        view()->share($assign);

    }

    public function index(): Factory|View
    {

        $articles = Article::query()
            ->select(['id', 'category_id', 'title', 'author', 'description', 'is_top', 'click', 'created_at', 'updated_at'])
            ->where('status', 1)
            ->orderByDesc('is_top')
            ->orderByDesc('created_at')
            ->with(['category', 'tags'])
            ->simplePaginate(6);

        return view('home.index', compact('articles'));
    }

    public function article($id, Request $request): Factory|View
    {
        $article = Article::query()->with([
            'category',
            'tags',
        ])->where('id', $id)->first();
        if (is_null($article) || 0 === $article->status || ! is_null($article->deleted_at)) {
            abort(404);
        }
        $key = 'articleRequestList:'.$id.':'.$request->ip();
        if (! Cache::has($key)) {
            Cache::put($key, $request->ip(), 60);
            $article->increment('click');
        }

        $prev = Article::query()->select('id', 'title')
            ->orderBy('created_at', 'asc')
            ->where([
                ['id', '>', $id],
                ['status', '=', Article::PUBLISHED],
            ])
            ->limit(1)
            ->first();

        $next = Article::query()->select('id', 'title')
            ->orderBy('created_at', 'desc')
            ->where([
                ['id', '<', $id],
                ['status', '=', Article::PUBLISHED],
            ])
            ->limit(1)
            ->first();

        return view('home.article', compact('article', 'prev', 'next'));
    }

    public function category($id): Factory|View
    {
        $category = Category::query()->findOrFail($id);
        $childCategoryList = Category::query()->where(['parent_id' => $id])
            ->get();
        $articles = Article::query()
            ->select(['id', 'category_id', 'title', 'author', 'description', 'click', 'created_at', 'updated_at'])
            ->where(['status' => Article::PUBLISHED, 'category_id' => $id])
            ->orderBy('created_at', 'desc')
            ->with(['category', 'tags'])
            ->simplePaginate(10);

        return view('home.category', compact('articles', 'category', 'childCategoryList'));
    }

    public function tag($id): Factory|View
    {
        $tag = ArticleTag::query()->findOrFail($id);
        $ids = ArticleTagRel::query()->where(['article_tag_id' => $id])->pluck('article_id')
            ->toArray();
        $articles = Article::query()
            ->select(['id', 'category_id', 'title', 'author', 'description', 'click', 'created_at', 'updated_at'])
            ->where('status', Article::PUBLISHED)
            ->whereIn('id', $ids)
            ->orderBy('created_at', 'desc')
            ->with(['category', 'tags'])
            ->simplePaginate(10);

        return view('home.tag', compact('articles', 'tag'));
    }

    public function archive(): Factory|View
    {
        $archive = Article::query()
            ->select(DB::raw('DATE_FORMAT(created_at, \'%Y-%m\') as time, count(*) as posts'))
            ->where('status', Article::PUBLISHED)
            ->groupBy('time')
            ->orderBy('time', 'desc')
            ->simplePaginate(3);
        foreach ($archive as $v) {
            $start = date('Y-m-d', strtotime($v->time));
            $end = date('Y-m-d', strtotime('+1 Month', strtotime($v->time)));
            $articles = Article::query()->select('id', 'title')
                ->where('status', Article::PUBLISHED)
                ->whereBetween('created_at', [$start, $end])
                ->orderBy('created_at', 'desc')
                ->get();
            $v->articles = $articles;
        }

        return view('home.archive', compact('archive'));
    }

    public function search(): Factory|View
    {
        $keyword = request()->input('keyword');
        $map = [
            ['title', 'like', '%'.$keyword.'%'],
            ['status', '=', Article::PUBLISHED],
        ];
        $articles = Article::query()
            ->select(['id', 'category_id', 'title', 'author', 'description', 'click', 'created_at', 'updated_at'])
            ->where($map)
            ->orderBy('created_at', 'desc')
            ->with(['category', 'tags'])
            ->simplePaginate(8);
        $articles->count = Article::query()->where($map)->count();

        return view('home.search', compact('articles'));
    }
}
