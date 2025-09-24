<?php 
namespace Controller;

use service\UsuarioService;
use Template\UsuarioTemp;
use Generic\Controller;

class UsuarioController extends Controller
{
    private $usuarioService;
    private $template;

    public function __construct()
    {
        $this->template = new UsuarioTemp();
        $this->usuarioService = new UsuarioService();
        if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
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
            $usuario = $this->usuarioService->fazerLogin($email, $senha);
            if($usuario){
                $_SESSION['usuario'] = $usuario;
                header("Location: public/Usuario/home.php");
                exit;
            }
        } else {
            echo $resultado['mensagem'];
        }
    }

    public function login($email, $senha){

        return $this->usuarioService->fazerLogin($email, $senha);

   }


    public function logout()
    {
        session_destroy();
        $this->redirect("index.php?c=usuario&a=form");
    }

}

