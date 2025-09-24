<?php
namespace generic;

use PDO;

class MysqlFactory{
    public MysqlSingleton $banco;
    public function __construct(){
        $this->banco = MysqlSingleton::getInstance();

    }
    public function getConnection()
{
    return $this->banco->getPdo();
}
}