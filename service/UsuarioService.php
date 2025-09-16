<?php 
namespace service;

use dao\mysql\UsuarioDAO;

class UsuarioService {  
private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function cadastrarUsuario($nome, $email, $senha) {
        if ($this->usuarioDAO->buscarPorEmail($email)) {
            return ['status' => false, 'mensagem' => 'Email já cadastrado.'];
        }

        if ($this->usuarioDAO->criarUsuario($nome, $email, $senha)){
            return ['status' => true, 'mensagem' => 'Usuário cadastrado com sucesso.'];
        } 
            return ['status' => false, 'mensagem' => 'Erro ao cadastrar usuário.'];
        
    }

    public function fazerLogin($email, $senha) {
        $usuario = $this->usuarioDAO->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            return ['status' => true, 'mensagem' => 'Login realizado com sucesso.'];
        }
        
        return ['status' => false, 'mensagem' => 'Email ou senha incorretos.'];
    }
}


