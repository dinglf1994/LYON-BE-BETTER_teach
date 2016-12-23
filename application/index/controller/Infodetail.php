<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-20
 * Time: 下午10:06
 */

namespace app\index\controller;

use think\Controller;

class InfoDetail extends Controller
{
    public function detail()
    {
        return $this->fetch('detail');
    }
}