<?php
namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\Request;
use think\Session;

class Index extends Controller
{
    protected $request;
    protected $admin;
    public function __construct(Request $request = null, Admin $admin)
    {
        parent::__construct($request);
        $this->request = $request;
        $this->admin = $admin;
    }

    public function index()
    {
        jumpLogin();
        return $this->fetch('index');
    }
    public function checkLogin()
    {
        $adminId = $this->request->post('adminid', '', 'string');
        $password = $this->request->post('password', '', 'string');
        if (empty($adminId) || empty($password)) {
            $this->error('参数错误');
        }
        $this->canLogin($this->admin, $adminId, $password);
    }
    private function canLogin($model, $adminId, $password)
    {
        $adminId = intval($adminId);
        $where = ['aid' => $adminId];
        $field = ['aid', 'passwd', 'name', 'auth'];
        $admin = $model->findOne($where, $field);
        if (!empty($admin)) {
            if (password_verify($password, $admin['passwd'])) {
                Session::set('aid', $adminId);
                Session::set('name', $admin['name']);
                $this->success('登录成功', '/admin/home/home');
            } else {
                $this->error('密码错误');
            }
        } else {
            $this->error('不存在该管理员');
        }
    }
    public function signOut()
    {
        Session::clear();
        $this->success('已经退出', '/admin');
    }
}
