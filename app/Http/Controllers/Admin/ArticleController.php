<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\Store;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\ArticleTagRel;
use App\Models\Category;
use App\Models\Feed;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @var Article
     */
    protected $article;

    /**
     * ArticleController constructor.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * 列举文章列表
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage(Request $request)
    {
        $keyword = $request->get('keyword') ?? '';
        $category = $request->get('category') ?? 0;
        $map = [];
        $keyword ? array_push($map, ['title', 'like', '%'.$keyword.'%']) : null;
        $category ? array_push($map, ['category_id', '=', $category]) : null;
        $articles = $this->article
            ->query()
            ->select(
                'id',
                'category_id',
                'title',
                'status',
                'is_top',
                'click',
                'created_at'
            )
            ->where($map)
            ->with('category')
            ->orderByDesc('is_top')
            ->orderByDesc('created_at')
            ->paginate(10);

        $categories = Tool::getSelect(Category::all()->toArray(), $category);

        return view('admin.article', compact('articles', 'categories'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function top($id)
    {
        $article = $this->article->query()->find($id);
        $status = (int) $article->is_top;
        $saved_status = abs(1 - $status);
        $article->is_top = $saved_status;
        $article->save();

        return redirect()->route('article_manage');
    }

    /**
     * 创建文章
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Tool::getSelect(Category::all()->toArray());
        $tag = ArticleTag::all();

        return view('admin.article-create', compact('category', 'tag'));
    }

    /**
     * 存储文章.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {

        $this->article->storeData($request->all());
        Tool::recordOperation(auth()->user()->name, '添加文章');

        return redirect()->route('article_manage');
    }

    /**
     * 编辑文章.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->article->query()->find($id);
        $category = Tool::getSelect(
            Category::all()->toArray(),
            $article->getAttributeValue('category_id')
        );
        $tag = ArticleTag::all();

        return view(
            'admin.article-edit',
            compact('article', 'category', 'tag')
        );
    }

    /**
     * 更新文章.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Store $request, $id)
    {
        $oldStatus = $this->article->query()->where('id', $id)->value('status');
        $data = $request->except('_token');
        $this->article->updateData($id, $data);
        Tool::recordOperation(auth()->user()->name, '编辑文章');

        return redirect()->route('article_manage');
    }

    /**
     * 软删除.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $data = $request->only('aid');
        $arr = explode(',', $data['aid']);
        $map = [
            'id' => ['in', $arr],
        ];
        $this->article->destroyData($map);
        Tool::recordOperation(auth()->user()->name, '软删除文章');

        return redirect()->back();
    }

    /**
     * 显示回收站列表.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $articles = $this->article->query()
            ->select('id', 'title', 'deleted_at')
            ->orderBy('deleted_at', 'desc')
            ->onlyTrashed()
            ->paginate(10);

        return view('admin.article-trash', compact('articles'));
    }

    /**
     * 恢复删除
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function restore(Request $request)
    {
        $data = $request->only('aid');
        $arr = explode(',', $data['aid']);
        if (! $this->article->query()->whereIn('id', $arr)->restore()) {
            Tool::showMessage('恢复失败', false);

            return redirect()->back();
        }
        Tool::showMessage('恢复成功');
        Tool::recordOperation(auth()->user()->name, '恢复软删除文章');

        return redirect()->back();
    }

    /**
     * 彻底删除文章.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $data = $request->only('aid');
        $arr = explode(',', $data['aid']);
        $deleteOrFail = $this->article->query()->whereIn('id', $arr)
            ->forceDelete();
        if (! $deleteOrFail) {
            // 删除对应标签记录与评论记录
            Tool::showMessage('彻底删除失败', false);

            return redirect()->back();
        } else {
            ArticleTagRel::query()
                ->whereIn('article_id', $arr)
                ->delete();
            Feed::query()
                ->where('target_type', Feed::TYPE_ARTICLE)
                ->whereIn('target_id', $arr)
                ->delete();
        }
        Tool::showMessage('彻底删除成功');
        Tool::recordOperation(auth()->user()->name, '完全删除文章');
        Tool::bdPush($arr, 'del');

        return redirect()->back();
    }

    /**
     * 上传图片
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage()
    {
        $field = 'mde-image-file';
        $rule
            = [$field => 'required|max:2048|image|dimensions:max_width=1920,max_height=1080'];
        $uploadPath = 'uploads/content';
        $result = Tool::uploadFile($field, $rule, $uploadPath, false, true);
        if ($result['status_code'] == 200) {
            $file = $result['data'];
            if (Tool::config('water_mark_status')) { // 加水印
                Tool::addImgWater(
                    $file['absolutePath'],
                    config('global.image_water_mark')
                );
            }

            return response()->json([
                'code' => 200,
                'filename' => $file['publicPath'],
            ]);
        } else {
            return response()->json([
                'code' => $result['status_code'],
                'filename' => $result['message'],
            ]);
        }
    }
}
