<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleTag\Store;
use App\Http\Requests\ArticleTag\Update;
use App\Models\ArticleTag;
use App\Models\ArticleTagRel;
use Illuminate\Http\Request;

class ArticleTagController extends Controller
{
    /**
     * @var ArticleTag
     */
    protected $articleTag;

    /**
     * TagController constructor.
     */
    public function __construct(ArticleTag $articleTag)
    {
        $this->articleTag = $articleTag;
    }

    /**
     * 标签管理列表.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $tags = $this->articleTag->query()->orderBy('id', 'desc')->paginate(10);
        foreach ($tags as $tag) {
            $articleCount = ArticleTagRel::query()->where('article_tag_id', $tag->id)
                ->count();
            $tag->article_count = $articleCount;
        }

        return view('admin.tag', compact('tags'));
    }

    /**
     * 标签创建存储.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->articleTag->storeData($request->all());
        Tool::recordOperation(auth()->user()->name, '添加标签');

        return redirect()->back();
    }

    /**
     * 标签编辑.
     *
     * @param  null  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id = null)
    {
        if (is_null($id)) {
            return abort(404, '对不起，找不到相关页面');
        }
        if (! $response = $this->articleTag->query()->find($id)->toArray()) {
            return Tool::ajaxReturn(404, ['alert' => '未找到相关数据']);
        }

        return Tool::ajaxReturn(200, $response);
    }

    /**
     * 标签更新.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request)
    {
        $id = $request->get('id');
        $name = $request->get('edit_name');
        $flag = $request->get('edit_name');
        $this->articleTag->updateData(['id' => $id],
            ['name' => $name, 'flag' => $flag]);
        Tool::recordOperation(auth()->user()->name, '编辑标签');

        return redirect()->back();
    }

    /**
     * 标签删除.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $data = $request->only('tid');
        $arr = explode(',', $data['tid']);
        $map = [
            'id' => ['in', $arr],
        ];
        $this->articleTag->destroyData($map);
        Tool::recordOperation(auth()->user()->name, '删除标签');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $map = [
            ['name', 'like', '%'.$keyword.'%'],
        ];
        $tags = $this->articleTag->query()->orderBy('id', 'desc')->where($map)
            ->paginate(10);
        foreach ($tags as $tag) {
            $articleCount = ArticleTagRel::query()->where('article_tag_id', $tag->id)
                ->count();
            $tag->article_count = $articleCount;
        }

        return view('admin.tag', compact('tags'));
    }
}
