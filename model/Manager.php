<?php
namespace OCFram\Blog\Model;
require_once('model/Singleton.php');

class Manager extends Singleton {
    protected function dbConnect() {
        $instance = Singleton::getInstance();
        $db = $instance->getConnection();
        return $db;
    }
}