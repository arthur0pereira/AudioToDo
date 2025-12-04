<?php

namespace dao\mysql;

use dao\IUsuarioDao;
use generic\MysqlFactory;

class UsuarioDao extends MysqlFactory implements IUsuarioDao
{

    public function criarUsuario($nome, $email, $senha)
    {

        $sql = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha)";

        $param = [
            ":nome" => $nome,
            ":email" => $email,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT)
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno > 0;
    }

    public function buscarPorEmail($email)
    {
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $param = [':email' => $email];
        $result = $this->banco->executar($query, $param);
        return $result ? $result[0] : null;
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $param = [':id' => $id];
        $result = $this->banco->executar($query, $param);
        return $result ? $result[0] : null;
    }

    public function atualizarUsuario($id, $nome, $email, $senha)
    {
        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email
        ];
        $sql = "UPDATE usuarios SET nome = :nome, email = :email";
        if (!empty($senha)) {
            $sql .= ", senha_hash = :senha";
            $params[':senha'] = password_hash($senha, PASSWORD_DEFAULT);
        }
        $sql .= " WHERE id = :id";
        $retorno = $this->banco->executar($sql, $params);
        return $retorno;
    }

    public function excluirUsuario($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $param = [":id" => $id];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }
}
