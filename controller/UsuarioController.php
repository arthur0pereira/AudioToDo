<?php

namespace Controller;

use service\UsuarioService;

use Generic\Controller;

class UsuarioController extends Controller
{
    private $usuarioService;


    public function __construct()
    {

        $this->usuarioService = new UsuarioService();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }



    public function salvar()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        $nome = $data["nome"] ?? '';
        $email = $data["email"] ?? '';
        $senha = $data["senha"] ?? '';

        $resultado = $this->usuarioService->cadastrarUsuario($nome, $email, $senha);
        if ($resultado['status']) {
            $usuario = $this->usuarioService->fazerLogin($email, $senha);
            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                return $resultado;
            }
        } else {
            echo $resultado['mensagem'];
        }
    }

    public function login($email, $senha)
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        $senha = $data["senha"] ?? null;
        $email = $data["email"] ?? null;

        $validacao = $this->usuarioService->fazerLogin($email, $senha);

        if (is_array($validacao) && isset($validacao["id"], $validacao["nome"])) {

            $id   = $validacao["id"];
            $nome = $validacao["nome"];

            $token = $this->autenticar($id, $nome);

            return [
                "erro"  => null,
                "dados" => $token
            ];
        } else {
            return [
                "erro" => "Credenciais inválidas"
            ];
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /AudioToDo/public/Usuario/login.php");
        exit;
    }
    public function atualizar()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        $id = $data['id'] ?? '';
        $nome = $data['nome'] ?? '';
        $email = $data['email'] ?? '';
        $senha = $data['senha'] ?? '';

        $resultado = $this->usuarioService->atualizarUsuario($id, $nome, $email, $senha);

        if ($resultado['status']) {
            $_SESSION['usuario']['nome'] = $nome;
            $_SESSION['usuario']['email'] = $email;
            return [
                "message" => "Alteraçao bem-sucedido."
            ];
        } else {
            echo $resultado['mensagem'];
        }
    }
    public function excluir()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        $id = $data['id'] ?? '';
        $ok = $this->usuarioService->excluirUsuario($id);

        if ($ok['status']) {
            session_destroy();
            return ["message" => "Conta excluída com sucesso!"];
        } else {
            return ["erro" => "Erro ao excluir usuário."];
        }
    }
    public function autenticar($id, $nome)
    {
        $service = new UsuarioService();
        return $service->autenticar($id, $nome);
    }
}
