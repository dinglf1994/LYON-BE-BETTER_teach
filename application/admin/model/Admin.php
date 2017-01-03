<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午12:35
 */

namespace app\admin\model;


use think\Config;
use think\Model;
use \app\admin\repositories\SqlInterface;

class Admin extends Model implements SqlInterface
{
    protected $opModel;

    /**
     * 初始化操作
     */
    public function _init()
    {
        $this->opModel = new Admin();
    }

    /**
     * @param $sql
     * 检验sql语句
     */
    public function _checkSql($sql)
    {
        // TODO: Implement _checkSql() method.
    }

    /**
     * @param null $where
     * @param null $field
     * @return mixed
     * 查找一条数据
     */
    public function findOne($where = null, $field = null)
    {
        $this->_init();
        if ($field == null) {
            return $this->opModel->where($where)->find();
        } else {
            return $this->opModel->where($where)->field($field)->find();
        }
    }

    /**
     * @param null $where
     * @param null $field
     * @return mixed
     * 查找所有符合的数据
     */
    public function findAll($where = null, $field = null)
    {
        $this->_init();
        if ($field == null) {
            return $this->opModel->select();
        } else {
            return $this->opModel->where($where)->field($field)->select();
        }
    }

    /**
     * @param bool $where
     * @param null $field
     * @return array
     * 分页显示查询
     */
    public function page($where = true, $field = null)
    {
        $this->_init();
        if ($field == null) {
            $list = $this->opModel->where($where)->paginate(Config::get('paginate.list_rows'));
        } else {
            $list = $this->opModel->where($where)->field($field)->paginate(Config::get('paginate.list_rows'));
//            $list = $this->opModel->where($where)->field($field)->paginate(1);
        }
        $page = $list->render();
        return ['list' => $list, 'page' => $page];
    }

    /**
     * @param $where
     * @param $data
     * 更新操作
     */
    public function updateTable($where, $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $data
     * @return bool
     * 插入一条数据
     */
    public function insertOne($data)
    {
        $this->_init();
        if ($this->opModel->save($data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param bool $where
     * @return bool
     * 删除操作
     */
    public function deleteOne($where = true)
    {
        $this->_init();
        if ($this->opModel->where($where)->delete()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param null $where
     * @return bool
     * 更新操作
     */
    public function updateOne($where = null, $data)
    {
        $this->_init();
        if ($where == null) {
            return false;
        } else {
            if ($this->opModel->where($where)->update($data)) {
                return true;
            } else {
                return false;
            }
        }
    }
}