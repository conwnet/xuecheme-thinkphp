<?php

namespace app\api\controller;
use think\Config;
use think\Request;
use think\Validate;
use app\api\model;

class Verify extends Access
{
    public function index()
    {
        return Config::get('name');

        return json([
            'errcode' => 0,
            'errmsg' => '欢迎使用学车么'
        ]);
    }

    public function smsCode() {
        $data = input('get.');
        $validate = new Validate(['mobile' => 'require|/1[34578]{1}\d{9}$/']);
        if(!$validate->check($data)) {
            return json([
                'errcode' => 1001,
                'errmsg' => '手机号码不正确'
            ]);
        }
        $this->set('sms_mobile', $data['mobile']);
        $this->set('sms_code', substr('0000' . rand(), -4));
        $this->set('sms_time_out', time() + 1800);
        $config = Config::get('alidayu');
        define('TOP_SDK_WORK_DIR', CACHE_PATH.'sms_tmp/');
        define('TOP_SDK_DEV_MODE', false);
        vendor('alidayu.TopClient');
        vendor('alidayu.AlibabaAliqinFcSmsNumSendRequest');
        vendor('alidayu.RequestCheckUtil');
        vendor('alidayu.ResultSet');
        vendor('alidayu.TopLogger');
        $c = new \TopClient;
        $c->appkey = $config['appkey'];
        $c->secretKey = $config['secretKey'];
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend('');
        $req->setSmsType('normal');
        $req->setSmsFreeSignName($config['FreeSignName']);
        $req->setSmsParam(json_encode([
            'code' => $this->get('sms_code'),
            'product' => '学车么'
        ]));
        $req->setRecNum($data['mobile']);
        $req->setSmsTemplateCode("SMS_62860286");
        $result = $c->execute($req);
        if(isset($result->code) && intval($result->code)) {
            return json([
                'errocde' => '1002',
                'errmsg' => '发送失败！'
            ]);
        } else return json([
            'errcode' => 0,
            'errmsg' => '发送成功！'
        ]);
    }

    public function smsCheck() {
        $code = input('post.code');
        if($code == $this->get('sms_code')) {
            return json([
                'errcode' => 0,
                'errmsg' => '验证成功！'
            ]);
        } else {
            return json([
                'errcode' => '1003',
                'errmsg' => '验证码错误！'
            ]);
        }
    }

    /*
     * 注册接口，通过短信验证码
     * POST 方式
     */
    public function regist() {
        $code = input('post.code');
        $password = input('post.password');
        if(strlen($password) < 5) {
            return json([
                'errcode' => 2001,
                'errmsg' => '密码太简单啦，应该不少于 5 位！'
            ]);
        }
        if(model\User::get(['username' => $this->get('sms_mobile')])) {
            return json([
                'errcode' => 2002,
                'errmsg' => '此手机号已注册！'
            ]);
        }

        if($this->check($code)) {
            $user = new model\User;
            $user->username = $this->get('sms_mobile');
            $user->password = encry($password);
            $user->save();
            return json([
                'errcode' => 0,
                'errmsg' => '注册成功！'
            ]);
        } else {
            return json([
                'errcode' => 1003,
                'errmsg' => '验证码错误！'
            ]);
        }
    }


    /*
     * 忘记密码接口，通过短信验证码
     * POST 方式
     */
    public function forget() {
        $code = input('post.code');
        $password = input('post.password');
        if(strlen($password) < 5) {
            return json([
                'errcode' => 2001,
                'errmsg' => '密码格式不正确！'
            ]);
        }
        $user = model\User::get(['username' => $this->get('sms_mobile')]);
        if(!$user) return json([
            'errcode' => 2005,
            'errmsg' => '此手机号还未注册！'
        ]);

        if($this->check($code)) {
            $user->password = encry($password);
            $user->save();
            return json([
                'errcode' => 0,
                'errmsg' => '密码重置成功！'
            ]);
        } else {
            return json([
                'errcode' => 1003,
                'errmsg' => '验证码错误！'
            ]);
        }
    }

    /*
     * 登录接口
     * 通过账号密码
     *
     */
    public function login() {
        $username = input('post.username');
        $password = input('post.password');
        $user = model\User::get(['username' => $username]);
        if(!$user) return json(['errcode' => 2003, 'errmsg' => '用户不存在...']);
        if(encry($password) == $user->password) {
            $this->set('user_id', $user->id);
            return json([
                'errcode' => 0,
                'errmsg' => '登录成功！',
                'user_id' => $user->id
            ]);
        } else {
            return json([
                'errcode' => 2004,
                'errmsg' => '密码错误！'
            ]);
        }
    }

    /*
     * 注销接口
     *
     */
    public function logout() {
        $this->set('user_id', 0);
        return json([
            'errcode' => 0,
            'errmsg' => '注销成功！'
        ]);
    }

    public function get_user_id_by_ssid() {
        return json([
            'errcode' => 0,
            'errmsg' => '获取成功！',
            'user_id' => $this->get('user_id')
        ]);
    }

}