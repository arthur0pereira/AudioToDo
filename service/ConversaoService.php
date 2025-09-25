<?php
namespace Service;

use Dao\Mysql\ConversaoDao;

class ConversaoService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new ConversaoDao();
    }

    public function criar($usuarioId, $texto, $voz, $audioId = null)
    {
        if (empty($texto)) {
            return ["status" => false, "mensagem" => "Texto obrigatório"];
        }

        $ok = $this->dao->criarConversao($usuarioId, $texto, $voz, $audioId);
        return ["status" => $ok, "mensagem" => $ok ? "Conversão criada!" : "Erro ao salvar"];
    }

    public function listar($usuarioId)
    {
        return $this->dao->listarPorUsuario($usuarioId);
    }

    public function excluir($id)
    {
        return $this->dao->excluir($id);
    }

    public function listarPorUsuario($usuarioId)
    {
        $conversoes = []; 
        return $conversoes;
    }

    public function buscarPorId($id)
    {
        return $this->dao->buscarPorId($id);
    }

    public function atualizar($id, $texto, $voz)
    {
        return $this->dao->atualizarConversao($id, $texto, $voz);
    }
    
}
