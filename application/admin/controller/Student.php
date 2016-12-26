<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-25
 * Time: 下午11:34
 */

namespace app\admin\controller;

use app\admin\model\Academy;
use app\admin\model\Department;
use think\Controller;
use think\Request;
use app\admin\model\Student as Stud;

class Student extends Controller
{
    protected $student;
    protected $academy;
    protected $department;
    public function __construct(Request $request = null, Stud $student, Academy $academy, Department $department)
    {
        parent::__construct($request);
        $this->student = $student;
        $this->academy = $academy;
        $this->department = $department;
    }

    /**
     * @return mixed
     *  学生信息展示
     */
    public function studentList()
    {
        $academic = $this->academy->findAll();
        $department = $this->department->findAll();
        $page = $this->student->page();
        $this->assign('academic', $academic);
        $this->assign('department', $department);
        $this->assign('list', $page['list']);
        $this->assign('page', $page['page']);
        return $this->fetch();
    }

    /**
     * 学生信息录入
     */
    public function studentInput()
    {

    }

    /**
     * 修改学生信息
     */
    public function studentUpdate()
    {
        if (!empty($this->request->post())) {
            $data = $this->param();
            $where = $data['where'];
            if ($this->student->updateOne($where, $data['stu'])) {
                $this->success('学生信息更新完成');
            } else {
                $this->error('更新学生信息失败');
            }
        } else {
            $this->error('参数错误');
        }
    }

    /**
     *
     */
    public function delete()
    {
        if (!empty($this->request->get())) {
            $this->student->deleteOne();
        } else {
            $this->error('参数错误');
        }
    }
    /**
     * @return mixed
     * 提交参数过滤
     */
    protected function param()
    {
        $where['snum'] = intval(trim($this->request->post('snum', '', 'string')));
        $stu['sname'] = trim($this->request->post('sname', '', 'string'));
        $stu['snickname'] = trim($this->request->post('snickname', '', 'string'));
        $stu['gender'] = $this->request->post('gender', '', 'string');
        switch ($stu['gender']) {
            case '男' : $stu['gender'] = 'M';
                break;
            case '女' : $stu['gender'] = 'F';
                break;
        }
        $stu['nation'] = trim($this->request->post('nation', '', 'string'));
        $stu['aid'] = intval($this->request->post('academic_id', '', 'string'));
        $stu['did'] = intval($this->request->post('department_id', '', 'string'));
        $stu['qq'] = trim($this->request->post('qq', '', 'string'));
        $stu['wei'] = trim($this->request->post('wei', '', 'string'));
        $stu['motto'] = trim($this->request->post('motto', '', 'string'));
        $stu['email'] = trim($this->request->post('email', '', 'string'));
        $stu['addr'] = trim($this->request->post('addr', '', 'string'));
        $stu['tags'] = trim($this->request->post('tags', '', 'string'));
        $stu['hobby'] = trim($this->request->post('hobby', '', 'string'));
        $stu['describe'] = trim($this->request->post('describe', '', 'string'));

        return ['stu' => $stu, 'where' => $where];
    }
}