<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Helpers\Extensions\UserExt;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    /**
     * 控制台首页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $newArticles = Article::query()->orderBy('created_at', 'desc')
            ->limit('6')->get();
        $articlesCount = Article::query()->count('id');
        $pagesCount = Page::query()->count('id');

        return view('admin.index', compact('newArticles', 'articlesCount', 'pagesCount'));
    }

    /**
     * 缓存清理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        Artisan::call('flush:cache');
        Tool::showMessage('缓存清理成功');
        Tool::recordOperation(UserExt::getAttribute('name'), '缓存清理');

        return redirect()->back();
    }
}
