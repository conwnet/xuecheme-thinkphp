<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\model\Session;

class Open extends Controller
{
    /*
     * 获取新的 ssid，如果 header 携带原来的 ssid 并且有效，
     * 则更新原来 ssid 的数据
     *
     */
    public function get_ssid() {
        $ssid = hash('sha256', 'xcm_' . rand() . time() . rand());
        $time_out = time() + 7200;

        $header = Request::instance()->header();
        $session = Session::get(isset($header['ssid']) ? $header['ssid'] : '');
        if($session) $session->save(['ssid' => $ssid, 'time_out' => $time_out]);
        else Session::create(['ssid' => $ssid, 'time_out' => $time_out]);

        return json([
            'errcode' => 0,
            'errmsg' => '获取成功！ ',
            'ssid' =>  $ssid,
            'time_out' => $time_out
        ]);
    }

    /*
     * 根据 ssid 获取 user_id
     */

    public function get_user_id() {
        $header = Request::instance()->header();
        $ssid = isset($header['ssid']) ? $header['ssid'] : '';
        $value = map($ssid);
    }
}
