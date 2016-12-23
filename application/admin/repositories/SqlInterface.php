<?php
/**
 * Created by PhpStorm.
 * User: lyon
 * Date: 16-12-23
 * Time: 下午12:39
 */

namespace app\admin\repositories;


interface SqlInterface
{
    public function _init();

    public function _checkSql($sql);

    public function findOne($where, $field);

    public function findAll($where, $field);

    public function updateTable($where, $data);
}