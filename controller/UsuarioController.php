<?php 
namespace generic; 

use service\UsuarioService;
use template\UsuarioTemp;
use template\Itemplate;

class UsuarioController {
        
    private UsuarioService $usuarioService;
    private ITemplate $template;
    
    public function __construct(){
        $this->template = new UsuarioTemp();
    }

    // public function listar(){
    //     $service = new UsuarioService();
    //     $resultado = $service->listarUsuarios();
    //     $this->template->layout("\\public\\Usuario\\listar.php", $resultado);
    // }

    public function inserir(){
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $service = new UsuarioService();
        $service->cadastrarUsuario($nome, $email, $senha);
        header('Location: public/Usuario/cadastrar.php');
    }

    // public function formulario(){
    //     $this->template->layout("\\public\\usuario\\form.php");
    // }

    // public function alterarForm(){
    //     $id = $_GET["id"];
    //     $service = new UsuarioService();
    //     $resultado = $service->buscarUsuarioPorId($id);

    //     $this->template->layout("\\public\\usuario\\form.php", $resultado);
    // }
}
