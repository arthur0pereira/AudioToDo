<?php 

require_once "generic/Controller.php";
require_once "service/UsuarioService.php";

use Generic\Controller;

class UsuarioController extends Controller
{
    private $usuarioService;

    public function __construct()
    {
        $this->usuarioService = new UsuarioService();
        session_start();
    }

    public function form()
    {
        $this->render("Usuario/form");
    }

    public function salvar()
    {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $resultado = $this->usuarioService->cadastrarUsuario($nome, $email, $senha);
        if ($resultado['status']) {
            $this->redirect("index.php?c=usuario&a=listar");
        } else {
            echo $resultado['mensagem'];
        }
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $usuario = $this->usuarioService->fazerLogin($email, $senha);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            $this->redirect("index.php?c=usuario&a=listar");
        } else {
            echo "Usuário ou senha inválidos!";
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("index.php?c=usuario&a=form");
    }

}

