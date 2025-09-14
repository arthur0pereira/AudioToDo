<?php
require_once 'generic/MysqlSingleton.php';

use generic\MysqlSingleton;

$mysql = MysqlSingleton::getInstance();
if ($mysql->isConnected()) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Falha na conexão!";
}