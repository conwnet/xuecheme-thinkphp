<?php
/**
 * Created by PhpStorm.
 * User: netcon@live.com
 * Date: 2017/7/20
 * Time: 14:26
 */

namespace app\api\controller;

use app\api\model;
use think\Validate;


class Course
{
   public function getCourseList() {
       $year = input('get.year');
       $month = input('get.month');
       $date = input('get.date');
       $coach_id = input('get.coach_id');
       $type = input('get.type');

       $validate = new Validate([
           'year' => 'require',
           'month' => 'require',
           'date' => 'require',
           'coach_id' => 'require',
           'type' => 'require'
       ]);

       if(!$validate->check(input('get.'))) {
           return json([
               'errcode' => 6001,
               'errmsg' => '输入参数错误！'
           ]);
       }
       if(!$coach_id || !model\Coach::get($coach_id)) return json([
           'errcode' => 6002,
           'errmsg' => '教练 id 错误！'
       ]);

       $courses = model\Course::all(['year' => $year,
           'month' => $month, 'date' => $date,
           'coach_id' => $coach_id, 'type' => $type]);
       if(!$courses) {
           $betimes = [];
           for($i = 0; $i < 10; $i++)
               $betimes[] = ['begin' => 480 + 60 * $i, 'end' => 540 + 60 * $i];
           foreach($betimes as $v) {
               model\Course::create([
                   'coach_id' => $coach_id,
                   'stu_id' => 0,
                   'begin' => $v['begin'],
                   'end' => $v['end'],
                   'year' => $year,
                   'month' => $month,
                   'date' => $date,
                   'type' => $type,
               ]);
           }
       }
       $courses = model\Course::all(['year' => $year, 'month' => $month, 'date' => $date, 'coach_id' => $coach_id]);
       $rets = [];
       foreach ($courses as $v) {
           $rets[] = [
               'id' => $v->id,
               'begin' => $v->begin,
               'end' => $v->end,
               'stu_id' => $v->stu_id
           ];
       }
        return json([
            'errcode' => 0,
            'errmsg' => '获取课程信息成功！',
            'courses' => $rets
        ]);
   }
}