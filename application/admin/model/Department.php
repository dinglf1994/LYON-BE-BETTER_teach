<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-26
 * Time: 下午6:28
 */

namespace app\admin\model;

use app\admin\repositories\SqlInterface;
use think\Model;

class Department extends Model implements SqlInterface
{
    protected $opModel;
    public function _init()
    {
        $this->opModel = new Department();
        // TODO: Implement _init() method.
    }
    public function _checkSql($sql)
    {
        // TODO: Implement _checkSql() method.
    }
    public function findOne($where, $field)
    {
        // TODO: Implement findOne() method.
    }
    public function findAll($where = true, $field = '*')
    {
        $this->_init();
        return $this->opModel->where($where)->field($field)->select();
    }
    public function updateTable($where, $data)
    {
        // TODO: Implement updateTable() method.
    }
}