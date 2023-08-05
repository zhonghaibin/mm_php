<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Http\Requests\Nav\Store;
use App\Http\Requests\Nav\Update;
use App\Models\Nav;
use Illuminate\Http\Request;

class NavController extends Controller
{
    /**
     * @var Nav
     */
    protected $nav;

    /**
     * NavController constructor.
     */
    public function __construct(Nav $nav)
    {
        $this->nav = $nav;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage()
    {
        $navs = $this->nav->getTreeIndex();
        $emptyNavs = $this->nav->query()
            ->select('id', 'name')
            ->where('type', $this->nav::TYPE_EMPTY)
            ->get();

        return view('admin.nav', compact('navs', 'emptyNavs'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        if ($request->get('parent_id') == 0) {
            $count = $this->nav->query()->where('parent_id', 0)->count();
            if ($this->nav::LIMIT_NUM == $count) {
                Tool::showMessage('一级菜单已达到最大限制', false);

                return redirect()->back();
            }
        }
        $this->nav->storeData($request->all());
        Tool::recordOperation(auth()->user()->name, '添加菜单');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $navs = $this->nav->getTreeIndex();
        $editNav = $this->nav->query()->find($id);
        $emptyNavs = $this->nav->query()
            ->select('id', 'name')
            ->where('type', $this->nav::TYPE_EMPTY)
            ->get();

        return view('admin.nav-edit', compact('navs', 'editNav', 'emptyNavs'));

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Update $request, $id)
    {
        $this->nav->updateData(['id' => $id], $request->except('_token'));
        Tool::recordOperation(auth()->user()->name, '编辑菜单');

        return redirect()->route('nav_manage');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $data = $request->only('nid');
        $arr = explode(',', $data['nid']);
        $map = [
            'id' => ['in', $arr],
        ];
        $this->nav->destroyData($map);
        Tool::recordOperation(auth()->user()->name, '删除菜单');

        return redirect()->back();
    }
}
