<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-30
 * Time: 下午2:58
 */

namespace app\index\controller;

use think\Controller;

class UserCenter extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}