<?php
namespace generic;

class Controller {
    private $arrChamadas = [];
    public function __construct($arrChamadas) {
        $this->arrChamadas = [
            "suario/cadastrar" => new Acao("UsuarioController", "store"),
            "usuario/login" => new Acao("UsuarioController", "login"),
            "usuario/editar" => new Acao("UsuarioController", "update"),
            "usuario/logout" => new Acao("UsuarioController", "logout"),
        ];
    }

    public function verificarChamadas($rota){

        if(isset($this->arrChamadas[$rota])){
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return ;
        }
        echo "Rota não encontrada.";
    }
}