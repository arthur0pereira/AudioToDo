<?php
namespace generic;

class MysqlSingleton{
    private static $conexao = null;
    private static $instance;

    private function __construct(){
        if(self::$conexao === null){
            try{
                $host = 'localhost';
                $dbname = 'bd1';
                $user = 'root'; 
                $pass = ''; 
                $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";
                self::$conexao = new \PDO($dns, $user, $pass);
                self::$conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }catch(\PDOException $e){
                echo "Erro na conexão: " . $e->getMessage();
            }
        }
    }

    public static function getInstance(): MysqlSingleton{
        if(!isset(self::$instance)){
            self::$instance = new MysqlSingleton();
        }
        return self::$instance;
    }

    public function executar(string $query, array $param = []){
        if(self::$conexao){
            $sth = self::$conexao->prepare($query);
            foreach($param as $k => $v){
                $sth->bindValue($k, $v);
            }
            $sth->execute();
            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        }
        return false;
    }
    
    public function isConnected(): bool {
        return self::$conexao !== null;
    }
}
