<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\Store;
use App\Models\Feed;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @var Page
     */
    protected $page;

    /**
     * PageController constructor.
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage(Request $request)
    {
        $keyword = $request->get('keyword') ?? '';
        $map = [];
        $keyword ? array_push($map, ['title', 'like', '%'.$keyword.'%']) : null;
        $pages = $this->page
            ->query()
            ->select('id', 'title', 'status', 'click', 'created_at')
            ->where($map)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.page', compact('pages'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.page-create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $this->page->storeData($request->all());
        Tool::recordOperation(auth()->user()->name, '添加单页');

        return redirect()->route('page_manage');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page = $this->page->query()->find($id);

        return view('admin.page-edit', compact('page'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Store $request, $id)
    {
        $data = $request->except('_token');
        $this->page->updateData($id, $data);
        Tool::recordOperation(auth()->user()->name, '编辑单页');

        return redirect()->route('page_manage');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $data = $request->only('pid');
        $arr = explode(',', $data['pid']);
        $map = [
            'id' => ['in', $arr],
        ];
        $this->page->destroyData($map);
        Tool::recordOperation(auth()->user()->name, '软删除单页');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $pages = $this->page->query()
            ->select('id', 'title', 'deleted_at')
            ->orderBy('deleted_at', 'desc')
            ->onlyTrashed()
            ->paginate(10);

        return view('admin.page-trash', compact('pages'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request)
    {
        $data = $request->only('pid');
        $arr = explode(',', $data['pid']);
        if (! $this->page->query()->whereIn('id', $arr)->restore()) {
            Tool::showMessage('恢复失败', false);

            return redirect()->back();
        }
        Tool::showMessage('恢复成功');
        Tool::recordOperation(auth()->user()->name, '恢复软删除单页');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $data = $request->only('pid');
        $arr = explode(',', $data['pid']);
        $deleteOrFail = $this->page->query()->whereIn('id', $arr)
            ->forceDelete();
        if (! $deleteOrFail) {
            Tool::showMessage('彻底删除失败', false);

            return redirect()->back();
        } else {
            Feed::query()
                ->where('target_type', Feed::TYPE_PAGE)
                ->whereIn('target_id', $arr)
                ->delete();
        }
        Tool::showMessage('彻底删除成功');
        Tool::recordOperation(auth()->user()->name, '完全删除单页');

        return redirect()->back();
    }

    public function show($id)
    {
        $article = $this->page->query()->find($id);
        $status = (int) $article->status;
        $saved_status = abs(1 - $status);
        $article->status = $saved_status;
        $article->save();

        return redirect()->route('page_manage');
    }
}
