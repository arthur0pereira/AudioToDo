<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

// Processa texto enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';

    if (!empty($texto)) {
        $arquivo = "audio_" . time() . ".txt"; // futuramente será .mp3
        file_put_contents(__DIR__ . "/../../audios/" . $arquivo, $texto);

        $linkAudio = "audios/" . $arquivo;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<h2>Nova Conversão</h2>
<form method="post" action="index.php?c=conversao&a=criar">
    <textarea name="texto" required placeholder="Digite o texto aqui"></textarea><br><br>
    <label>Voz:</label>
    <select name="voz">
        <option value="padrão">Padrão</option>
        <option value="masculina">Masculina</option>
        <option value="feminina">Feminina</option>
    </select><br><br>
    <button type="submit">Converter</button>
</form>
</html>


