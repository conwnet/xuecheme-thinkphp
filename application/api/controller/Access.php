<?php
namespace app\api\controller;


use think\Controller;
use think\Request;
use app\api\model\Session;
use think\exception\HttpResponseException;


class Access extends Controller
{
    private $ssid = '';
    private $time_out = 0;
    private $user_id = '';
    private $sms_mobile = '';
    private $sms_code = '';
    private $sms_time_out = '';
    private $session = NULL;

    public function _initialize() {
        $header = Request::instance()->header();
        $ssid = isset($header['ssid']) ? $header['ssid'] : '';
        if(!($ssid && $this->session = Session::get($ssid))) {
            throw new HttpResponseException(json([
                'errcode' => '-1',
                'errmsg' => '身份验证失败！'
            ], 403));
        } else {
            $this->ssid = $this->session->ssid;
            $this->time_out = $this->session->time_out;
            $this->user_id = $this->session->user_id;
            $this->sms_mobile = $this->session->sms_mobile;
            $this->sms_code = $this->session->sms_code;
            $this->sms_time_out = $this->session->sms_time_out;
        }
    }

    public function set($key, $value) {
        $this->$key = $value;
        $this->session->save([$key => $value]);
    }

    public function get($key) {
        return $this->$key;
    }

    public function check($code) {
        if($this->code == $code && $this->code != -1) {
            $this->code = -1;
            return true;
        } else {
            return false;
        }
    }
}
