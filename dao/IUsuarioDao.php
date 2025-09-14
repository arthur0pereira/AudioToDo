<?php
namespace dao;

interface IUsuarioDao {
    public function criarUsuario($nome, $email, $senha);
    public function buscarPorEmail($email);
    public function buscarPorId($id);
    public function atualizarUsuario($id, $nome, $email, $senha);
}