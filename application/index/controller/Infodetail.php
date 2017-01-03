<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-20
 * Time: 下午10:06
 */

namespace app\index\controller;

use app\index\model\Teacher;
use app\index\model\Tevaluate;
use think\Controller;
use think\Request;
use think\Session;

class InfoDetail extends Controller
{
    protected $teacher;
    protected $tEvaluate;
    public function __construct(Request $request = null, Teacher $teacher, Tevaluate $tEvaluate)
    {
        parent::__construct($request);
        $this->teacher = $teacher;
        $this->tEvaluate = $tEvaluate;
    }

    public function detail()
    {
        if (!empty($this->request->get())) {
            $where['id'] = intval($this->request->get('tid'));
            if (!empty($data = $this->teacher->findOne($where, null))) {
                $eva['tid'] = intval($data['tnum']);
                $evaluate = $this->tEvaluate->evaluate($eva);
                $this->assign('evaluate', $evaluate);
                $this->assign('teacherInfo', $data);
                $this->assign('eid', Session::get('uid'));
                $this->assign('tid', $data['tnum']);
                $this->assign('ename', Session::get('nickname'));
                return $this->fetch('detail');
            } else {
                $this->error('抱歉, 教师信息更新中');
            }
        } else {
            $this->error('抱歉,页面不存在');
        }
    }

    public function updateEvaluate()
    {
        if (!empty($this->request->post())) {
            $data['eid'] = intval($this->request->post('sid'));
            $data['tid'] = intval($this->request->post('tid'));
            $data['content'] = $this->request->post('content');
            $data['etime'] = date('Y-m-d H:i:s');
            if ($data['eid'] != '' && $data['tid'] != '' && $data['content'] != '') {
                $this->tEvaluate->insertEvaluate($data);
            }
        } else {
            $data = ['code' => 2, 'data' => 'error'];
            return $data;
        }
    }
}