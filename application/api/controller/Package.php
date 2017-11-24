<?php
/**
 * Created by PhpStorm.
 * User: netcon@live.com
 * Date: 2017/7/24
 * Time: 16:44
 */

namespace app\api\controller;

use app\api\model;


class Package
{
    public function getPackageList() {
        $school_id = input('get.school_id');
        $packages = model\Package::all(['school_id' => $school_id]);
        if(!$packages) return json(['errcode' => 4001, 'errmsg' => '驾校 id 不正确！']);
        $rets = [];
        foreach ($packages as $k => $v) {
            $rets[] = [
                'id' => $v->id,
                'title' => $v->title,
                'headimg' => $v->headimg,
                'desc' => $v->desc,
                'price' => $v->price,
                'cout' => $v->count,
            ];
        }
        return json([
            'errcode' => 0,
            'errmsg' => '获取套餐列表成功！',
            'packages' => $rets
        ]);
    }

    public function getSchoolInfo() {
        $id = input('get.id');
        if(!$id) return json(['errcode' => 4001, 'errmsg' => '驾校 id 不正确！']);
        $school = model\School::get($id);
        return json([
            'name' => $school->name,
            'count' => $school->count,
            'over_avg' => 90,
            'item2_avg' => 96,
            'item3_avg' => 95
        ]);
    }
}