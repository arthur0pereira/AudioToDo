<?php

namespace service;

use dao\IUsuarioDao;
use dao\mysql\UsuarioDao;
use generic\JWTAuth;
use JWTAuth as GlobalJWTAuth;
use stdClass;

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

            $ok = $this->usuarioDao->criarUsuario($nome, $email, $senha);

            if ($ok) {
                return ['status' => true, 'mensagem' => 'Usuário cadastrado com sucesso.'];
            }

            return ['status' => false, 'mensagem' => 'Erro ao cadastrar usuário.'];
        } catch (\Exception $e) {
            return ['status' => false, 'mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }


    public function fazerLogin($email, $senha)
    {
        $usuario = $this->usuarioDao->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {

            return $usuario;
        }
        return false;
    }

    public function atualizarUsuario($id, $nome, $email, $senha)
    {
        $ok = $this->usuarioDao->atualizarUsuario($id, $nome, $email, $senha);
        if ($ok > 0) {
            return ['status' => true, 'mensagem' => 'Perfil atualizado!'];
        }
        return ['status' => false, 'mensagem' => 'Erro ao atualizar perfil.'];
    }

    public function excluirUsuario($id)
    {
        $ok = $this->usuarioDao->excluirUsuario($id);

        if ($ok > 0) {
            return ['status' => true];
        }

        return ['status' => false];
    }
    public function autenticar($usuario_id, $nome)
    {


        $jwt = new GlobalJWTAuth();
        $objeto = new stdClass();
        $objeto->id = "$usuario_id";
        $objeto->nome = "$nome";

        return $jwt->criarchave(json_encode($objeto));
    }
}
