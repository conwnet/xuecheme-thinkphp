<?php
/**
 * Created by PhpStorm.
 * User: netcon@live.com
 * Date: 2017/7/24
 * Time: 16:44
 */

namespace app\api\controller;

use app\api\model;
use function foo\func;


class School
{
    public function getSchoolList() {
        $schools = model\School::all();
        $rets = [];
        foreach ($schools as $k => $v) {

            $package = model\Package::get(function ($query) use ($v) {
                $query->where('school_id', '=', $v->id)->order('price');
            });

            $rets[] = [
                'id' => $v->id,
                'name' => $v->name,
                'headimg' => $v->headimg,
                'count' => $v->count,
                'score' => $v->score,
                'min_price' => $package->price,
                'labels' => ['车接车送', '服务好']
            ];
        }
        return json([
            'errcode' => 0,
            'errmsg' => '获取驾校列表成功！',
            'schools' => $rets
        ]);
    }

    public function getSchoolInfo() {
        $id = input('get.id');
        $school = model\School::get($id);
        if(!$school) return json(['errcode' => 4001, 'errmsg' => '驾校 id 不正确！']);
        return json([
            'errcode' => 0,
            'errmsg' => '获取驾校信息成功！',
            'school' => [
                'name' => $school->name,
                'count' => $school->count,
                'banners' => json_decode($school->banners),
                'over_avg' => 90,
                'item2_avg' => 96,
                'item3_avg' => 95
            ]
        ]);
    }
}