<?php
namespace Controller;

use Service\ConversaoService;
use Generic\Controller;

class ConversaoController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new ConversaoService();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function criar()
    {
        $usuarioId = $_SESSION['usuario']['id'];
        $texto = $_POST['texto'] ?? '';
        $voz = $_POST['voz'] ?? 'padrão';
        $audioId = null;

        $resultado = $this->service->criar($usuarioId, $texto, $voz, $audioId);

        header("Location: index.php?c=conversao&a=listar&msg=" . urlencode($resultado['mensagem']));
        exit;
    }

    public function listar()
    {
        $usuarioId = $_SESSION['usuario']['id'];
        $conversoes = $this->service->listar($usuarioId);

        $this->render("Usuario/home", ['conversoes' => $conversoes]);
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? 0;
        $this->service->excluir($id);

        header("Location: index.php?c=conversao&a=listar");
        exit;
    }
}
