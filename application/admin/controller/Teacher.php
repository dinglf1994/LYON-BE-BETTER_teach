<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-25
 * Time: 下午11:39
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Teacher extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * 教师信息展示
     */
    public function teacherList()
    {

    }

    /**
     * 教师信息录入
     */
    public function teacherInput()
    {

    }
}