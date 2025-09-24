<?php
namespace Service;

use Dao\Mysql\AudioDao;

class AudioService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new AudioDao();
    }

    public function salvar($conversaoId, $caminhoArquivo, $formato, $tamanhoBytes)
    {
        return $this->dao->salvar($conversaoId, $caminhoArquivo, $formato, $tamanhoBytes);
    }

    public function buscarPorId($id)
    {
        return $this->dao->buscarPorId($id);
    }

    public function listarPorConversao($conversaoId)
    {
        return $this->dao->listarPorConversao($conversaoId);
    }

    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }
}