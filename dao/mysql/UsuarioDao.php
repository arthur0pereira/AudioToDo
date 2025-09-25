<?php
namespace dao\mysql;

use dao\IUsuarioDao;
use generic\MysqlFactory;

class UsuarioDao extends MysqlFactory implements IUsuarioDao{

    public function criarUsuario($nome, $email, $senha)
    {
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha)";
            $stmt = $this->banco->getPdo()->prepare($sql);
            return $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => password_hash($senha, PASSWORD_DEFAULT)
            ]);
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
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
    
    public function atualizarUsuario($id, $nome, $email, $senha)
    {
        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email
        ];
        $sql = "UPDATE usuarios SET nome = :nome, email = :email";
        if (!empty($senha)) {
            $sql .= ", senha = :senha";
            $params[':senha'] = password_hash($senha, PASSWORD_DEFAULT);
        }
        $sql .= " WHERE id = :id";
        $stmt = $this->banco->getPdo()->prepare($sql);
        return $stmt->execute($params);
    }

    public function excluirUsuario($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->banco->getPdo()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

}