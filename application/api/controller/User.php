<?php
/**
 * Created by PhpStorm.
 * User: netcon@live.com
 * Date: 2017/7/20
 * Time: 14:26
 */

namespace app\api\controller;

use app\api\model;


class User extends Access
{
    public function get_info() {
        if(!$this->get('user_id')) return json([
            'errcode' => 3001,
            'errmsg' => '您还没有登录...'
        ]);
        $user = model\User::get($this->get('user_id'));
        return json([
            'errcode' => 0,
            'errmsg' => '获取个人信息成功',
            'user' => [
                'name' => $user->name
            ]
        ]);
    }


}