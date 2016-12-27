<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午3:38
 */

namespace app\admin\model;


use app\admin\repositories\SqlInterface;
use think\Model;
use think\Config;

class Teacher extends Model implements SqlInterface
{
    protected $opModel;
    protected $table;
    public function _init($table = 'dwm_teacher')
    {
        $this->table = $table;
        $this->opModel = new Teacher();
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
     * 教师信息分页显示
     */
    public function page($where = true)
    {
        $this->_init();
        $list = $this->opModel->view('teacher', '*')
            ->view('academy', ['aid' => 'aaid', 'aname'], 'academy.aid = teacher.aid')
            ->view('department', ['did' => 'ddid', 'dname'], 'department.did = teacher.did')
            ->where($where)
            ->paginate(Config::get('paginate.list_rows'));
        $page = $list->render();
        return ['list' => $list, 'page' => $page];
    }

    /**
     * @param $data
     * @return bool
     * 更新一条教师信息
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
     * 删除一条教师信息
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
     * 添加教师信息
     * @param $data
     * @return void
     */
    public function saveArray($data)
    {
        $this->_init();
        if ($this->opModel->saveAll($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 添加一条教师信息
     */
    public function saveOne($data)
    {
        $this->_init();
        if ($this->opModel->save($data)) {
            return true;
        } else {
            return false;
        }
    }
}