<?php
/**
 * Created by PhpStorm.
 * User: netcon@live.com
 * Date: 2017/7/20
 * Time: 14:26
 */

namespace app\api\controller;

use app\api\model;


class Plan
{
   public function getPlanInfo() {
       $year = input('get.year');
       $month = input('get.month');
       $date = input('get.date');
       $coach_id = input('get.coach_id');

       $plan = model\Plan::get(['year' => $year, 'month' => $month, 'date' => $date, 'coach_id' => $coach_id]);
       if($plan) $ret = json_decode($plan->content);
       else $ret = [
           ['id']
       ];

   }
}