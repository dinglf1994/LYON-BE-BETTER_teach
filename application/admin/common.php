<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-21
 * Time: 上午10:11
 */

/**
 * 检测用户是否登录
 */
function isLogin()
{
    $name = \think\Session::get('name');
    $id = \think\Session::get('id');
    if (empty($name) && empty($id)) {
        echo "<script>alert('请登录'); parent.location.href='/admin'</script>";
    }
}
function jumpLogin()
{
    $name = \think\Session::get('name');
    $id = \think\Session::get('aid');
    if (!empty($name) && !empty($id)) {
        echo "<script>alert('已经登录'); parent.location.href='/admin/home/home'</script>";
    }
}