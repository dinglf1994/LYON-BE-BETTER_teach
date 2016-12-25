<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-25
 * Time: 下午11:34
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Student extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    /**
     * @return mixed
     *  学生信息展示
     */
    public function studentList()
    {
        return $this->fetch();
    }

    /**
     * 学生信息录入
     */
    public function studentInput()
    {

    }
}