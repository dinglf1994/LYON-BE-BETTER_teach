<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-29
 * Time: 下午2:44
 */

namespace app\index\model;

use app\index\repositories\SqlInterface;
use think\Model;

class TeachInfo extends Model implements SqlInterface
{
    protected $opModel;
    public function _init($table = 'dwm_teacherinfo')
    {
        $this->table = $table;
        $this->opModel = new TeachInfo();

    }
    public function _checkSql($sql)
    {
        // TODO: Implement _checkSql() method.
    }
    public function findOne($where, $field)
    {
        // TODO: Implement findOne() method.
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