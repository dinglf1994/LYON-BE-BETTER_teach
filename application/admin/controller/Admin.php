<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-25
 * Time: 下午2:53
 */

namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Admin as Adminer;

class Admin extends Controller
{
    protected $request;
    protected $admin;
    public function __construct(Request $request = null, Adminer $admin)
    {
        parent::__construct($request);
        $this->request = $request;
        $this->admin = $admin;
    }

    public function adminList()
    {
        $field = ['id', 'aid', 'name'];
        $page = $this->admin->page(true, $field);
        $this->assign('adminName', Session::get('name'));
        $this->assign('list', $page['list']);
//        var_dump($page);exit;
        $this->assign('page', $page['page']);
        return $this->fetch();
    }
    public function index()
    {
        $this->assign('adminName', Session::get('name'));
        return $this->fetch('admin/index');
    }
}