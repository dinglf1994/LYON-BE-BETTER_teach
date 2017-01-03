<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 17-1-1
 * Time: 下午4:40
 */

namespace app\index\model;


use app\index\repositories\SqlInterface;
use think\Model;

class Tevaluate extends Model implements SqlInterface
{
    protected $opModel;
    public function _init()
    {
        $this->opModel = new Tevaluate();
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
    public function findAll($where, $field)
    {
        // TODO: Implement findAll() method.
    }
    public function updateTable($where, $data)
    {
        // TODO: Implement updateTable() method.
    }

    /**
     * 获取教师评论信息
     * 时间倒叙排列
     */
    public function evaluate($where, $field = '*')
    {
        $this->_init();
        $list_stu = $this->opModel
            ->view('tevaluate', '*')
            ->view(['dwm_student' => 'estu'], ['sname' => 'ename', 'snickname' => 'nickname'], 'estu.snum = tevaluate.eid')
            ->where($where)
            ->select();
        $list_tea = $this->opModel
            ->view('tevaluate', '*')
            ->view(['dwm_teacher' => 'tstu'], ['tname' => 'ename', 'tnickname' => 'nickname'], 'tstu.tnum = tevaluate.eid')
            ->where($where)
            ->select();
        $list = array_merge($list_stu, $list_tea);
        return $list;
    }

    /**
     * 写入评论信息
     */
    public function insertEvaluate($data)
    {
        $this->_init();
        $this->opModel->save($data);
    }

}