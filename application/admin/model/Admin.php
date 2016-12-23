<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午12:35
 */

namespace app\admin\model;


use think\Model;
use \app\admin\repositories\SqlInterface;

class Admin extends Model implements SqlInterface
{
    protected $opModel;
    public function _init()
    {
        // TODO: Implement init() method.
        $this->opModel = new Admin();
    }

    public function _checkSql($sql)
    {
        // TODO: Implement _checkSql() method.
    }

    public function findOne($where = null, $field = null)
    {
        $this->_init();
        if ($field == null) {
            return $this->opModel->where($where)->find();
        } else {
            return $this->opModel->where($where)->field($field)->find();
        }
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