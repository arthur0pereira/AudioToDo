<?php
namespace Dao\Mysql;

use Generic\MysqlFactory;
use PDO;

class ConversaoDao
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new \generic\MysqlFactory())->getConnection();
    }

    public function criarConversao($usuarioId, $texto, $voz, $audioId = null)
    {
        $sql = "INSERT INTO conversoes (usuario_id, texto, voz_utilizada, status, audio_id) 
                VALUES (:usuario_id, :texto, :voz, 'processando', :audio_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':texto' => $texto,
            ':voz' => $voz,
            ':audio_id' => $audioId
        ]);
    }

    public function listarPorUsuario($usuarioId)
    {
        $sql = "SELECT * FROM conversoes WHERE usuario_id = :usuario_id ORDER BY data_criacao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':usuario_id' => $usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM conversoes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE conversoes SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':status' => $status,
            ':id' => $id
        ]);
    }

    public function atualizarAudio($id, $audioId)
    {
        $sql = "UPDATE conversoes SET audio_id = :audio_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':audio_id' => $audioId,
            ':id' => $id
        ]);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM conversoes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function atualizarConversao($id, $texto, $voz)
    {
        $sql = "UPDATE conversoes SET texto = :texto, voz_utilizada = :voz WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':texto' => $texto,
            ':voz' => $voz,
            ':id' => $id
        ]);
    }
}
