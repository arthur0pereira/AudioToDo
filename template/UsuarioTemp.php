<?php
namespace template;

class UsuarioTemp implements ITemplate{

    public function cabecalho(){
        echo "<div> Cabeçalho </div>";
    }
    public function rodape(){
        echo "<div> Rodapé </div>";
    }
    public function layout($caminho, $parametro = null){
        $this->cabecalho();
        include $_SERVER['DOCUMENT_ROOT']. "/AudioToDo/".$caminho;
        $this->rodape();
    }
}