<?php

namespace App\Helpers\Extensions;

/**
 * 工具助手函数
 * Class Tool
 */
class Tool
{
    /**
     * 字符串截取，支持中文和其他编码
     *
     * @param  string  $str 需要转换的字符串
     * @param  int  $start 开始位置
     * @param  string  $length 截取长度
     * @param  bool  $suffix 截断显示字符
     * @param  string  $charset 编码格式
     * @return string
     */
    public static function subStr($str, $start, $length, $suffix = true, $charset = 'utf-8')
    {
        $slice = mb_substr($str, $start, $length, $charset);
        $omit = mb_strlen($str) >= $length ? '...' : '';

        return $suffix ? $slice.$omit : $slice;
    }

    /**
     * 优化时间显示
     *
     * @param  mixed  $sTime 源时间
     * @param  int  $format
     * @return false|string
     */
    public static function transformTime($sTime, $format = 0)
    {

        // 如果是日期格式的时间;则先转为时间戳
        if (! is_int($sTime)) {
            $sTime = strtotime($sTime);
        }
        //sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime = time();
        $dTime = $cTime - $sTime;
        // 计算两个时间之间的日期差
        $date1 = date_create(date('Y-m-d', $cTime));
        $date2 = date_create(date('Y-m-d', $sTime));
        $diff = date_diff($date1, $date2);
        $dDay = $diff->days;

        if ($dTime == 0) {
            return '1秒前';
        } elseif ($dTime < 60 && $dTime > 0) {
            return $dTime.'秒前';
        } elseif ($dTime < 3600 && $dTime > 0) {
            return (int) ($dTime / 60).'分钟前';
        } elseif ($dTime >= 3600 && $dDay == 0) {
            return (int) ($dTime / 3600).'小时前';
        } elseif ($dDay == 1) {
            return date('昨天 H:i', $sTime);
        } elseif ($dDay == 2) {
            return date('前天 H:i', $sTime);
        } elseif ($format == 1) {
            return date('m-d H:i', $sTime);
        } else {
            // 不是今年
            if (date('Y', $cTime) != date('Y', $sTime)) {
                return date('Y-n-j', $sTime);
            }

            return date('n-j', $sTime);
        }
    }

    /**
     * ajax 返回数据
     *
     * @param  int  $code 返回代码
     * @param  mixed  $data 需要返回的数据
     * @return \Illuminate\Http\JsonResponse
     */
    public static function ajaxReturn($code, $data)
    {
        if ($code !== 200) {
            $data = ['status_code' => $code, 'message' => $data];

            return response()->json($data, $code);
        }
        if (is_object($data)) {
            $data = $data->toArray();
        }

        return response()->json($data, $code);
    }

    /**
     * 递归获取子孙目录树
     *
     * @param  array  $data 要转换的数据集
     * @param  int  $parent_id parent_id 字段
     * @return  array
     */
    public static function getRecursiveData($data, $parent_id = 0)
    {
        $new_arr = [];
        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $parent_id) {
                $new_arr[] = $v;
                unset($data[$k]);
            }
        }
        foreach ($new_arr as &$a) {
            $a['children'] = self::getRecursiveData($data, $a['id']);
            if (count($a['children']) === 0) {
                unset($a['children']);
            }
        }

        return $new_arr;
    }
}
