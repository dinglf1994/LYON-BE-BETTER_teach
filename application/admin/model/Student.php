<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午3:06
 */

namespace app\admin\model;


use app\admin\repositories\SqlInterface;
use think\Config;
use think\Model;

class Student extends Model implements SqlInterface
{
    protected $opModel;
    protected $table;
    public function _init($table = 'dwm_student')
    {
        $this->table = $table;
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

    /**
     * @param bool $where
     * @param string $field
     * @return array
     * 学生信息分页显示
     */
    public function page($where = true, $field = '*')
    {
        $this->_init();
        $list = $this->opModel->view('student', '*')
            ->view('academy', '*', 'academy.aid = student.aid')
            ->view('department', '*', 'department.did = student.did')
            ->where($where)
            ->paginate(Config::get('paginate.list_rows'));
        $page = $list->render();
        return ['list' => $list, 'page' => $page];
    }

    /**
     * @param $data
     * @return bool
     * 更新一条学生信息
     */
    public function updateOne($where, $data)
    {
        $this->_init();
        if ($this->opModel->where($where)->update($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除一条学生信息
     */
    public function deleteOne($where)
    {
        $this->_init();
        if ($this->opModel->where($where)->delete()) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * 更新学生信息
     * @param $data
     * @return void
     */
    public function saveArray()
    {
    }
}