<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-20
 * Time: 下午3:24
 */

namespace app\admin\controller;
use think\Controller;
use think\Request;

class Home extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        isLogin();
    }

    public function home()
    {
        $this->assign('name', 'Admin');
        return $this->fetch('home');
    }
    public function test()
    {
        return $this->fetch('test');
    }
}