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
        isLogin();
        $this->request = $request;
        $this->admin = $admin;
    }

    /**
     * @return mixed
     * 管理员列表
     */
    public function adminList()
    {
        $field = ['id', 'aid', 'name', 'register_time'];
        $page = $this->admin->page(true, $field);
        $this->assign('adminName', Session::get('name'));
        $this->assign('list', $page['list']);
        $this->assign('page', $page['page']);
        return $this->fetch();
    }

    /**
     * @return mixed
     * 管理员添加
     */
    public function adminAdd()
    {
        if (!empty($this->request->post())) {
            $data = $this->param();
            if ($this->admin->insertOne($data)) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        } else {
            $this->assign('adminName', Session::get('name'));
            return $this->fetch();
        }
    }

    /**
     * @return mixed
     * 管理员中心
     */
    public function index()
    {
        $this->assign('adminName', Session::get('name'));
        return $this->fetch('admin/index');
    }

    /**
     * 修改当前管理员信息
     */
    public function changePassword()
    {

    }

    /**
     * 删除管理员
     */
    public function delete()
    {
        if (!empty($this->request->get())) {
            $aid = $this->request->get('aid');
            $where = ['aid' => $aid];
            if ($this->admin->deleteOne($where)) {
                $this->success('删除成功');
            } else {
                $this->error('抱歉,删除失败');
            }
        } else {
            $this->error('抱歉,删除失败');
        }
    }

    public function adminUpdate()
    {
        if (!empty($this->request->post())) {
            $data = $this->param();
            if (empty($data['passwd'])) {
                unset($data['passwd']);
            }
            $where = ['aid' => $data['aid']];
            unset($data['aid']);
            unset($data['register_time']);
            if ($this->admin->updateOne($where,$data)) {
                $this->success('更新成功');
            } else {
                $this->error('更新失败');
            }
        } else {
            $this->error('抱歉,更新失败');
        }
    }

    /**
     * 过滤数据
     */
    public function param()
    {
        $admin['aid'] = trim($this->request->post('adminid'));
        if (!is_numeric($admin['aid'])) {
            $this->error('管理员编号只能为纯数字');
        }
        $admin['passwd'] = password_hash(trim($this->request->post('password')), PASSWORD_DEFAULT);
        $admin['name'] = trim($this->request->post('adminname'));
        $admin['auth'] = '';
        foreach ($this->request->post()["auth"] as $value) {
            $admin['auth'] .= $value . ',';
        }
        $admin['auth'] = substr($admin['auth'], 0, -1);
        $admin['register_time'] = date('Y-m-d H:i:s');
        return $admin;
    }
}