<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-25
 * Time: 下午11:47
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Message extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        isLogin();
    }

    /**
     * 站内信统计
     */
    public function index()
    {

    }

    /**
     * 站内信发送
     */
    public function sendMessage()
    {

    }
}