<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-20
 * Time: 下午3:24
 * 后台管理首页
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;

class Home extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        isLogin();
    }

    public function home()
    {
        $this->assign('adminName', Session::get('name'));
        return $this->fetch('home');
    }
    public function test()
    {
        return $this->fetch('test');
    }
}