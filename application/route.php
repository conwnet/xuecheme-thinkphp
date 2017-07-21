<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get([
    'api/ssid' => 'api/open/get_ssid',
    'api/sms' => 'api/verify/sms_code',
    'api/logout' => 'api/verify/logout',
]);


Route::post([
    'api/regist' => 'api/verify/regist',
    'api/login' => 'api/verify/login',
    'api/forget' => 'api/verify/forget'
]);

return [
];
