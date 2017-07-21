<?php
use think\Response;

function encry($str) {
    $_SALT = '_aImOmA.CoM?netCon';
    return hash('sha256', $_SALT . $str);
}

