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
    public function getUserInfo() {
        if(!$this->get('user_id')) return json([
            'errcode' => 3001,
            'errmsg' => '您还没有登录...'
        ]);
        $user = model\User::get($this->get('user_id'));
        return json([
            'errcode' => 0,
            'errmsg' => '获取个人信息成功',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'mobile' => $user->username,
                'headimg' => 'https://placehold.it/80x80'
            ]
        ]);
    }

    public function setUserInfo() {
        $name = input('post.name');
        if(!$name) return json([
            'errcode' => 3003,
            'errmsg' => '姓名格式不正确'
        ]);
        $user = model\User::get($this->get('user_id'));
        $user->save(['name' => $name]);
        return json([
            'errcode' => 0,
            'errmsg' => '修改成功！'
        ]);
    }
}