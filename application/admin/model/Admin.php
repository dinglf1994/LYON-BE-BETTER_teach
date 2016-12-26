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

    public function findAll($where = null, $field = null)
    {
        $this->_init();
        if ($field == null) {
            return $this->opModel->select();
        } else {
            return $this->opModel->where($where)->field($field)->select();
        }
    }

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
    public function updateTable($where, $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * 插入数据
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
}