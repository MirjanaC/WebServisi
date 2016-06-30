<?php

/**
 * Created by PhpStorm.
 * User: Zoran Luledzija
 * Date: 25-Jun-16
 * Time: 10:16 PM
 */

abstract class AbstractDao {

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public abstract function fetchById($id);

    public abstract function fetchAll();

    public abstract function save($data);

    public abstract function update($data);

    public abstract function delete($id);

}