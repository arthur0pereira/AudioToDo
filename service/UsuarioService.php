<?php 
namespace service;

use dao\IUsuarioDao;
use dao\mysql\UsuarioDao;

class UsuarioService
{
    private $usuarioDao;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
    }

    public function cadastrarUsuario($nome, $email, $senha)
    {
        try {
            if ($this->usuarioDao->buscarPorEmail($email)) {
                return ['status' => false, 'mensagem' => 'Email já cadastrado.'];
            }

            if ($this->usuarioDao->criarUsuario($nome, $email, $senha)){
                return ['status' => true, 'mensagem' => 'Usuário cadastrado com sucesso.'];
            } else {
                return ['status' => false, 'mensagem' => 'Erro ao cadastrar usuário.'];
            }
        } catch (\Exception $e) {
            return ['status' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }

    public function fazerLogin($email, $senha)
    {
        $usuario = $this->usuarioDao->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    public function atualizarUsuario($id, $nome, $email, $senha)
    {
        $ok = $this->usuarioDao->atualizarUsuario($id, $nome, $email, $senha);
        if ($ok) {
            return ['status' => true, 'mensagem' => 'Perfil atualizado!'];
        }
        return ['status' => false, 'mensagem' => 'Erro ao atualizar perfil.'];
    }

    public function excluirUsuario($id)
    {
        return $this->usuarioDao->excluirUsuario($id);
    }
}



