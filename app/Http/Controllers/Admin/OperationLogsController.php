<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Extensions\Tool;
use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use Illuminate\Http\Request;

class OperationLogsController extends Controller
{
    /**
     * @var OperationLog
     */
    protected $operation_logs;

    /**
     * OperationLogsController constructor.
     */
    public function __construct(OperationLog $operation_logs)
    {
        $this->operation_logs = $operation_logs;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage()
    {
        // 日志
        $operation_logs = $this->operation_logs
            ->query()
            ->select('id', 'operator', 'operation', 'operation_time', 'ip',
                'address', 'device', 'browser', 'platform', 'language',
                'device_type')
            ->orderBy('operation_time', 'desc')
            ->paginate(10);

        return view('admin.operation-logs', compact('operation_logs'));
    }

    /**
     * 日志删除.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $data = $request->only('opid');
        $arr = explode(',', $data['opid']);
        $map = [
            'id' => ['in', $arr],
        ];
        $this->operation_logs->destroyData($map);
        Tool::recordOperation(auth()->user()->name, '删除日志');

        return redirect()->back();
    }
}
