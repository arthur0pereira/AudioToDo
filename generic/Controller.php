<?php
namespace generic;

class Controller{
    private $arrChamadas = [];
    public function __construct(){
        
        $this->arrChamadas = [
            "usuario/form"      => new Acao("controller\\UsuarioController", "form"),
            "usuario/salvar"    => new Acao("controller\\UsuarioController", "salvar"),
            "usuario/atualizar" => new Acao("controller\\UsuarioController", "atualizar"),
            "usuario/login"     => new Acao("controller\\UsuarioController", "login"),
            "usuario/logout"    => new Acao("controller\\UsuarioController", "logout"),
            "usuario/excluir"   => new Acao("controller\\UsuarioController", "excluir"),
        ];    
    }

    public function verificarChamadas($rota){

        if(isset($this->arrChamadas[$rota])){
            // acao da rota
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return ;
        }

        echo "404 - Rota não encontrada!";
    }
}

