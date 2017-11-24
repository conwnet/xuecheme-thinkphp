<?php
namespace app\api\controller;

class Index
{
    public function index()
    {
        if([]) {
            return 'yes';
        } else {
            return 'no';
        }

        return json_encode([
            'errcode' => 0,
            'errmsg' => '欢迎使用学车么'
        ]);
    }

}
