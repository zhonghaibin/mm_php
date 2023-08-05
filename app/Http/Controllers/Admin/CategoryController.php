<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Store;
use App\Http\Requests\Category\Update;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * 列举文章栏目类别
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $categories = $this->category->getTreeIndex();
        foreach ($categories as $category) {
            // 文章数量统计
            $articleCount = Article::query()
                ->where('category_id', $category->id)->count();
            $category->article_count = $articleCount;
        }
        $levelOne = $this->category
            ->query()
            ->select('id', 'name')
            ->where('parent_id', 0)
            ->get();

        return view('admin.category', compact('categories', 'levelOne'));
    }

    /**
     * 存储文章栏目.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $this->category->storeData($request->all());
        Tool::recordOperation(auth()->user()->name, '添加栏目');

        return redirect()->route('category_manage');
    }

    /**
     * 编辑文章栏目类别.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->category->getTreeIndex();
        foreach ($categories as $category) {
            // 文章数量统计
            $articleCount = Article::query()
                ->where('category_id', $category->id)->count();
            $category->article_count = $articleCount;
        }
        $edit_category = $this->category->query()->find($id);
        $map = [
            ['parent_id', '=', 0],
            ['id', '<>', $id],
        ];
        $levelOne = $this->category->query()->select('id', 'name')->where($map)
            ->get();

        return view('admin.category-edit',
            compact('categories', 'edit_category', 'levelOne'));
    }

    /**
     * 更新文章栏目类别.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id)
    {
        $this->category->updateData(['id' => $id], $request->except('_token'));
        Tool::recordOperation(auth()->user()->name, '编辑栏目');

        return redirect()->route('category_manage');
    }

    /**
     * 删除栏目类别.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $data = $request->only('cid');
        $arr = explode(',', $data['cid']);
        $map = [
            'id' => ['in', $arr],
        ];
        $this->category->destroyData($map);
        Tool::recordOperation(auth()->user()->name, '删除栏目');

        return redirect()->back();
    }
}
