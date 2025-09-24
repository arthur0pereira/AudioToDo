<?php
namespace Dao\Mysql;

use Generic\MysqlFactory;
use PDO;

class AudioDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new \generic\MysqlFactory())->getConnection();
    }

    public function salvar($conversaoId, $caminhoArquivo, $formato, $tamanhoBytes)
    {
        $sql = "INSERT INTO audios (conversao_id, caminho_arquivo, formato, tamanho_bytes, data_criacao)
                VALUES (:conversao_id, :caminho_arquivo, :formato, :tamanho_bytes, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':conversao_id' => $conversaoId,
            ':caminho_arquivo' => $caminhoArquivo,
            ':formato' => $formato,
            ':tamanho_bytes' => $tamanhoBytes
        ]);
        return $this->conn->lastInsertId();
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM audios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listarPorConversao($conversaoId)
    {
        $sql = "SELECT * FROM audios WHERE conversao_id = :conversao_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':conversao_id' => $conversaoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM audios WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}