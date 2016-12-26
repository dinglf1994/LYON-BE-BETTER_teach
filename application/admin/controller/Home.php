<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-20
 * Time: 下午3:24
 * 后台管理首页
 */

namespace app\admin\controller;
use app\admin\model\Admin;
use think\Controller;
use think\Request;
use think\Session;

class Home extends Controller
{
    protected $admin;
    public function __construct(Request $request = null, Admin $admin)
    {
        parent::__construct($request);
        isLogin();
        $this->admin = $admin;
    }

    public function home()
    {
        $where = ['aid' => Session::get('aid')];
        $admin = $this->admin->findOne($where);
        $this->assign('adminId', Session::get('aid'));
        $this->assign('register_time', $admin['register_time']);
        $this->assign('adminName', Session::get('name'));
        return $this->fetch('home');
    }
    public function test()
    {
        return $this->fetch('test');
    }
}