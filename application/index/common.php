<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-21
 * Time: 上午10:20
 */

/**
 * 检测用户是否登录
 */
function isLogin()
{
    $name = \think\Session::get('name');
    $id = \think\Session::get('id');
    if (empty($name) && empty($id)) {
        echo "<script>alert('请登录'); parent.location.href='/index/login/login'</script>";
    }
}