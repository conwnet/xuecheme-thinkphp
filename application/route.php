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
    'api/ssid' => 'api/open/getSSid',
    'api/sms' => 'api/verify/smsCode',
    'api/logout' => 'api/verify/logout',
    'api/user_id' => 'api/verify/getUserId',

    'api/user' => 'api/user/getUserInfo',
    'api/schools' => 'api/school/getSchoolList',
    'api/school' => 'api/school/getSchoolInfo',

    'api/packages' => 'api/package/getPackageList',

    'api/coaches' => 'api/coach/getCoachList',
    'api/coach' => 'api/coach/getCoachInfo',

    'api/courses' => 'api/course/getCourseList'
]);


Route::post([
    'api/regist' => 'api/verify/regist',
    'api/login' => 'api/verify/login',
    'api/forget' => 'api/verify/forget',

    'api/user' => 'api/user/setUserInfo'
]);

return [
];
