<?php
namespace app\index\controller;
use app\index\model\Admin;
use app\index\model\Teacher;
use think\Controller;
use think\Request;
use \Endroid\QrCode\QrCode;

class Index extends Controller
{
    protected $admin;
    protected $teacher;
    public function __construct(Request $request = null, Admin $admin, Teacher $teacher)
    {
//        isLogin();
        parent::__construct($request);
        $this->admin = $admin;
        $this->teacher = $teacher;
    }
    public function index()
    {
        return $this->fetch('index/index');
    }
    public function home()
    {
        $data = $this->teacher->findForWaterPull(0, 12);
        $this->assign('data', $data);
        return $this->fetch('index/home');
    }
    public function qrCode()
    {
        $qrCode = new QrCode();
        $qrCode->setText('http://www.baidu.com')
            ->setSize(100)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        $qrCode->render();
    }

    /**
     * 瀑布流方式获取数据
     */
    public function waterPull()
    {
        if (!empty($this->request->post())) {
            $begin = $this->request->post('begin');
            $num = $this->request->post('num');
            $data = $this->teacher->findForWaterPull($begin, $num);
            if (!empty($data)) {
                $data = ['code' => 1, 'msg' => $data];
                return $data;
            } else {
                $data = ['code' => 2, 'msg' => '数据已经加载完'];
                return $data;
            }
        } else {
                $data = ['code' => 0, 'msg' => '参数错误'];
                return $data;
        }
    }
}
