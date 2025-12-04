<?php

namespace generic;

class Rotas
{
    private $endpoints = [];

    public function __construct()
    {
        $this->endpoints = [
            "usuario" => new Acao([
                Acao::POST => new Endpoint("UsuarioController", "salvar"),

                Acao::PUT => new Endpoint("UsuarioController", "atualizar", true),
                Acao::DELETE => new Endpoint("UsuarioController", "excluir", true)

            ]),
            "login" => new Acao([
                Acao::POST => new Endpoint("UsuarioController", "login")

            ])
        ];
    }
    public function executar($rota)
    {
        if (isset($this->endpoints[$rota])) {
            $endpoint = $this->endpoints[$rota];
            $dados = $endpoint->executar();
            $retorno = new Retorno();
            $retorno->dados = $dados;
            return $retorno;
        }
        return null;
    }
}
