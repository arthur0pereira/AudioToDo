<?php
namespace dao\mysql;

use dao\IUsuarioDao;
use generic\MysqlFactory;

class UsuarioDao extends MysqlFactory implements IUsuarioDao{

    public function criarUsuario($nome, $email, $senha){
        $query = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $param = [
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_BCRYPT)
        ];
        return $this->banco->executar($query, $param);
    }

    public function buscarPorEmail($email){
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $param = [':email' => $email];
        $result = $this->banco->executar($query, $param);
        return $result ? $result[0] : null;
    }

    public function buscarPorId($id){
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $param = [':id' => $id];
        $result = $this->banco->executar($query, $param);
        return $result ? $result[0] : null;
    }
    
    public function atualizarUsuario($id, $nome, $email, $senha){
        $query = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $param = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_BCRYPT)
        ];
        return $this->banco->executar($query, $param);
    }

}