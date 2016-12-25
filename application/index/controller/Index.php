<?php
namespace app\index\controller;
use app\index\model\Admin;
use think\Controller;
use think\Request;
use \Endroid\QrCode\QrCode;

class Index extends Controller
{
    protected $admin;
    public function __construct(Request $request = null, Admin $admin)
    {
//        isLogin();
        parent::__construct($request);
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
}
