<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午3:06
 */

namespace app\index\model;


use app\index\repositories\SqlInterface;
use think\Model;

class Student extends Model implements SqlInterface
{
    protected $opModel;

    public function _init()
    {
        $this->opModel = new Student();
    }
    public function _checkSql($sql)
    {
        // TODO: Implement _checkSql() method.
    }
    public function findOne($where, $field = null)
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
        // TODO: Implement updateTable() method.
    }
}