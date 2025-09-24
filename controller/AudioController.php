<?php

namespace Controller;

use Service\AudioService;
use Generic\Controller;

class AudioController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new AudioService();
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public function salvar()
    {
        $conversaoId = $_POST['conversao_id'] ?? null;
        $caminhoArquivo = $_POST['caminho_arquivo'] ?? '';
        $formato = $_POST['formato'] ?? '';
        $tamanhoBytes = $_POST['tamanho_bytes'] ?? 0;

        $audioId = $this->service->salvar($conversaoId, $caminhoArquivo, $formato, $tamanhoBytes);

        header("Location: index.php?c=audio&a=detalhar&id=" . $audioId);
        exit;
    }

    public function detalhar()
    {
        $id = $_GET['id'] ?? 0;
        $audio = $this->service->buscarPorId($id);

        $this->render("Audio/detalhar", ['audio' => $audio]);
    }

    public function excluir()
    {
        $id = $_GET['id'] ?? 0;
        $this->service->excluir($id);

        header("Location: index.php?c=conversao&a=listar");
        exit;
    }
}