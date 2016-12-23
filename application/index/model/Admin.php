<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午12:35
 */

namespace app\index\model;
//use think\Config;
use think\Model;
use \app\index\repositories\SqlInterface;

class Admin extends Model implements SqlInterface
{
    protected $table = 'dwm_admin';
    public function _init()
    {
        // TODO: Implement init() method.
    }

    public function _checkSql($sql)
    {
        // TODO: Implement _checkSql() method.
    }

    public function findOne($where = null, $field = null)
    {
        $admin = new Admin;
        return $admin->where('id', 1)->find();
    }

    public function findAll($where, $field)
    {
        // TODO: Implement findAll() method.
    }

    public function updateTable($where, $data)
    {
        // TODO: Implement update() method.
    }
}