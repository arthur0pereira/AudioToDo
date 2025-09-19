<?php 
namespace generic; 

use service\UsuarioService;

class UsuarioController {

    private $usuarioService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $resposta = $this->usuarioService->cadastrarUsuario($nome, $email, $senha);
            
            if ($resposta['status']) {
                header('Location: /login.php?mensagem=' . urlencode($resposta['mensagem']));
                exit();
            } else {
                header('Location: /cadastro.php?erro=' . urlencode($resposta['mensagem']));
                exit();
            }
        }
        
        include __DIR__ . '/../../public/cadastro.php';
    }
}
