<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * 列举配置目录.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view('admin.config');
    }

    /**
     * 更新配置.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Config $config)
    {
        $data = $request->except('_token');
        $editData = [];
        foreach ($data as $k => $v) {
            $editData[] = [
                'name' => $k,
                'value' => addslashes($v), // 临时处理转义配置单双引号
            ];
        }
        $config->updateBatch($editData);
        Tool::recordOperation(auth()->user()->name, '修改配置文件');

        return redirect()->back();
    }

    /**
     * 上传水印图片
     */
    public function uploadImage()
    {
        $field = 'water_mark';
        $rule
            = [$field => 'required|max:1024|image|dimensions:max_width=200,max_height=200'];
        $file = public_path('images/water_mark.png');
        if (file_exists($file)) {
            @unlink($file);
        } // TODO：水印问题
        $uploadPath = 'img';
        $fileName = 'water_mark';
        $result = Tool::uploadFile($field, $rule, $uploadPath, $fileName);
        $result['status_code'] === 200 ? Tool::showMessage('水印上传成功')
            : Tool::showMessage($result['message'], false);

        return redirect()->back();
    }
}
