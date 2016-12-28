<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-21
 * Time: 下午5:12
 * 登录控制
 * 依赖注入
 */

namespace app\index\controller;

use Gregwar\Captcha\CaptchaBuilder;
use app\index\model\Student;
use app\index\model\Teacher;
use think\Controller;
use think\Log;
use think\Request;
use think\response\Redirect;
use think\Session;

class Login extends Controller
{
    const STU = 1; //学生
    const TEA = 2; //教师
    protected $request;
    protected $student;
    protected $teacher;
    public function __construct(Request $request = null, Teacher $teacher, Student $student)
    {
        parent::__construct($request);
        $this->request = $request;
        $this->teacher = $teacher;
        $this->student = $student;
    }

    public function login()
    {
        return $this->fetch('login');
    }

    /**
     * 登录检测
     */
    public function checkLogin()
    {
        $verifyCode = $this->request->post('verify', '', 'string');
        $userId = $this->request->post('userid', 0, 'int');
        $password = trim($this->request->post('passwd', '', 'string'));
        $type = $this->request->post('type','', 'int');
        if (!$this->checkVerify($verifyCode)) {
            $this->error('验证码错误');
        }
        if (empty($userId) || empty($password) || empty($type)) {
            $this->error('参数错误');
        }
        switch ($type)
        {
            case self::STU : $this->canLogin($this->student, $userId, $password);
                break;
            case self::TEA : $this->canLogin($this->teacher, $userId, $password);
                break;
        }
    }
    private function canLogin($model, $userId, $password)
    {
        $userId = intval($userId);
        $where = ['snum' => $userId];
        $field = ['snum', 'snickname', 'spasswd'];
        $customer = $model->findOne($where, $field);
        if (!empty($customer)) {
            if (password_verify($password, $customer['spasswd'])) {
                Session::set('uid', $userId);
                Session::set('nickname', $customer['snickname']);
                $this->success('登录成功', '/index/index/home');
            } else {
                $this->error('密码错误');
            }
        } else {
            $this->error('不存在该用户');
        }
    }

    /**
     * 验证码生成
     */
    public function verify()
    {
        $builder = new CaptchaBuilder();
        $builder->build()->output();
        Session::set('verifyCode', $builder->getPhrase());
    }

    /**
     * @param $code
     * @return bool
     * 验证码检测
     */
    public function checkVerify($code)
    {
        return ($code == Session::get('verifyCode') && $code != '') ? true : false;
    }
}