<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-25
 * Time: 下午11:34
 */

namespace app\admin\controller;

use \PHPExcel_IOFactory as IOFactory;
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
    protected $IOFactory;
    public function __construct(Request $request = null, Stud $student, Academy $academy, Department $department)
    {
        parent::__construct($request);
        isLogin();
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
        if (!empty($this->request->post())) {
            $data = $this->param();
            $data['register_time'] = date('Y-m-d H:i:s');
            if ($this->student->saveOne($data)) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        } else {
            $academic = $this->academy->findAll();
            $department = $this->department->findAll();
            $this->assign('academic', $academic);
            $this->assign('department', $department);
            return $this->fetch();
        }
    }

    /**
     * 批量导入学生信息
     */
    public function studentInputAll()
    {
        if (!empty($this->request->file())) {
            $file = $this->request->file('stu_info');
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $data = $this->phpExcelIoFactory($info->getSaveName());
                if ($this->student->saveArray($data)) {
                    $this->success('批量导入成功');
                } else {
                    $this->error('批量导入失败');
                }
            } else {
                $this->error('导入失败');
            }
        } else {
            return $this->fetch();
        }
    }

    /**
     * 修改学生信息
     */
    public function studentUpdate()
    {
        if (!empty($this->request->post())) {
            $data = $this->param();
            $where['snum'] = $data['snum'];
            unset($data['snum']);
            if ($this->student->updateOne($where, $data)) {
                $this->success('学生信息更新完成');
            } else {
                $this->error('更新学生信息失败');
            }
        } else {
            $this->error('参数错误');
        }
    }

    /**
     * 删除学生信息
     */
    public function delete()
    {
        if (!empty($this->request->get())) {
            $where['snum'] = intval($this->request->get('snum'));
//            var_dump($where);exit;
            if ($this->student->deleteOne($where)) {
                $this->success('删除用户成功');
            } else {
                $this->error('删除用户失败');
            }
        } else {
            $this->error('参数错误');
        }
    }

    /**
     * @return mixed
     * 更新提交参数过滤 // 待优化把所有学生信息参数过滤
     */
    protected function param()
    {
//        var_dump($this->request->post());exit;
        $stu['snum'] = intval(trim($this->request->post('snum', '', 'string')));
        $stu['sname'] = trim($this->request->post('sname', '', 'string'));
        $stu['snickname'] = trim($this->request->post('snickname', '', 'string'));
        $stu['gender'] = $this->request->post('gender', '', 'string');
        switch ($stu['gender']) {
            case '男' : $stu['gender'] = 'M';
                break;
            case '女' : $stu['gender'] = 'F';
                break;
        }
        if ($this->request->post('enter_time') != '') {
            $stu['enter_time'] = $this->request->post('enter_time');
        }
        if ($this->request->post('password') != '') {
            $stu['spasswd'] = password_hash($this->request->port('password'), PASSWORD_DEFAULT);
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

        return $stu;
    }

    /**
     * 从excel中批量获取数据
     * @param $file
     * @return array
     */
    protected function phpExcelIoFactory($file)
    {

        set_time_limit(0);

        $file = ROOT_PATH . 'public' . DS . 'uploads' . DS . $file;
        if (file_exists($file)) {
            $mReader = IOFactory::createReader('Excel5');
            $phpExcel = $mReader->load($file);
            $sheet = $phpExcel->getSheet();
            //取得表格行数
            $highestRow = $sheet->getHighestRow();
            //取得总列数

            //获取所有信息
            $student = [];
            for ($row = 2; $row <= $highestRow; $row++) {
                $student[$row - 2]['snum'] = $sheet->getCellByColumnAndRow(0, $row)->getValue();
                $student[$row - 2]['sname'] = $sheet->getCellByColumnAndRow(1, $row)->getValue();
                $student[$row - 2]['snickname'] = $sheet->getCellByColumnAndRow(2, $row)->getValue();
                $student[$row - 2]['gender'] = $sheet->getCellByColumnAndRow(3, $row)->getValue();
                $student[$row - 2]['enter_time'] = date('Y-m-d',$sheet->getCellByColumnAndRow(4, $row)->getValue());
                $student[$row - 2]['register_time'] = date('Y-m-d H:i:s');
                $student[$row - 2]['aid'] = $sheet->getCellByColumnAndRow(5, $row)->getValue();
                $student[$row - 2]['did'] = $sheet->getCellByColumnAndRow(6, $row)->getValue();
                $student[$row - 2]['qq'] = $sheet->getCellByColumnAndRow(7, $row)->getValue();
                $student[$row - 2]['wei'] = $sheet->getCellByColumnAndRow(8, $row)->getValue();
                $student[$row - 2]['motto'] = $sheet->getCellByColumnAndRow(9, $row)->getValue();
                $student[$row - 2]['email'] = $sheet->getCellByColumnAndRow(10, $row)->getValue();
                $student[$row - 2]['addr'] = $sheet->getCellByColumnAndRow(11, $row)->getValue();
                $student[$row - 2]['nation'] = $sheet->getCellByColumnAndRow(12, $row)->getValue();
                $student[$row - 2]['spasswd'] = password_hash('123456', PASSWORD_DEFAULT);
                $student[$row - 2]['tags'] = $sheet->getCellByColumnAndRow(14, $row)->getValue();
                $student[$row - 2]['hobby'] = $sheet->getCellByColumnAndRow(15, $row)->getValue();
                $student[$row - 2]['describe'] = $sheet->getCellByColumnAndRow(16, $row)->getValue();
            }
            return $student;
        } else {
            $this->error('文件上传失败');
        }
    }
}