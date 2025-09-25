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
        if (!isset($_SESSION['usuario'])) {
            header("Location: /AudioToDo/public/Usuario/login.php");
            exit;
        }
        $usuarioId = $_SESSION['usuario']['id'];
        $conversoes = $this->service->listar($usuarioId);

        $this->render("Conversao/editar", ['conversoes' => $conversoes]);
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? 0;
        $this->service->excluir($id);

        header("Location: index.php?c=conversao&a=listar");
        exit;
    }

    public function editar()
    {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /AudioToDo/public/Usuario/login.php");
            exit;
        }

        $id = $_GET['id'] ?? 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $texto = $_POST['texto'] ?? '';
            $voz = $_POST['voz'] ?? 'padrão';

            // Atualiza no banco
            $ok = $this->service->atualizar($id, $texto, $voz);

            $msg = $ok ? "Conversão atualizada com sucesso!" : "Erro ao atualizar conversão.";
            header("Location: index.php?c=conversao&a=listar&msg=" . urlencode($msg));
            exit;
        }

        // Busca conversão para editar
        $conversao = $this->service->buscarPorId($id);

        $this->render("Conversao/editar_form", ['conversao' => $conversao]);
    }
}
