<?php
/**
 * Created by PhpStorm.
 * User: netcon@live.com
 * Date: 2017/7/20
 * Time: 14:26
 */

namespace app\api\controller;

use app\api\model;


class Coach
{
    public function getCoachList() {
        $type = input('get.type');
        $coaches = model\Coach::all(['type' => $type]);
        $rets = [];
        foreach($coaches as $v) {
            $user = model\User::get($v->user_id);
            $rets[] = [
                'id' => $v->id,
                'name' => $user->name,
                'headimg' => $user->headimg ? $user->headimg : 'http://placehold.it/80x80',
                'desc' => $v->desc,
                'day_count' => 12,
                'score' => $v->score,
                'labels' => ['气质优雅', '服务好'],
                'price' => $v->price
            ];
        }
        return json([
            'errcode' => 0,
            'errmsg' => '获取教练列表成功！',
            'coaches' => $rets
        ]);
    }

    public function getCoachInfo() {
        $id = input('get.id');
        $coach = model\Coach::get($id);
        $user = model\User::get($coach->user_id);
        if(!$coach || !$user) {
            return json([
                'errcode' => 5001,
                'errmsg' => '教练 id 不正确！'
            ]);
        }
        return json([
            'errcode' => 0,
            'errmsg' => '获取教练信息成功！',
            'coach' => [
                'headimg' => $user->headimg ? $user->headimg : 'http://placehold.it/100x100',
                'name' => $user->name,
                'score' => $coach->score,
                'course_count' => 128,
                'price' => $coach->price
            ]
        ]);
    }
}