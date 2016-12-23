<?php
namespace app\index\controller;
use app\index\model\Admin;
use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    protected $admin;
    public function __construct(Request $request = null, Admin $admin)
    {
        parent::__construct($request);
        isLogin();
        $this->admin = $admin;
    }
    public function index()
    {
        return $this->fetch('index/index');
    }
    public function home()
    {
        return $this->fetch('index/home');
    }
}
