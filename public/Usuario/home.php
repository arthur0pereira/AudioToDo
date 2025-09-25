<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $texto = $_POST['texto'] ?? '';
    $voz = $_POST['voz'] ?? 'padrão';

    if (!empty($texto)) {
        // Exemplo de chamada para uma API local de TTS
        $apiUrl = "http://localhost:8080/api/tts"; // ajuste conforme sua API
        $postData = [
            'text' => $texto,
            'voice' => $voz
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $audioContent = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($audioContent && $httpCode === 200) {
            $arquivo = "audio_" . time() . ".mp3";
            file_put_contents(__DIR__ . "/../../audios/" . $arquivo, $audioContent);
            $linkAudio = "/AudioToDo/audios/" . $arquivo;
        } else {
            $erro = "Erro ao gerar áudio! (HTTP $httpCode)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Conversão</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="container">
        <h2>Nova Conversão</h2>
        <form method="post" action="">
            <textarea name="texto" required placeholder="Digite o texto aqui"></textarea>

            <label>Voz:</label>
            <select name="voz">
                <option value="padrão">Padrão</option>
                <option value="masculina">Masculina</option>
                <option value="feminina">Feminina</option>
            </select>

            <button type="submit">Converter</button>
        </form>

        <?php if (isset($linkAudio)): ?>
            <h3>Ouça ou baixe seu áudio:</h3>
            <audio controls src="<?= $linkAudio ?>"></audio>
            <br>
            <a href="<?= $linkAudio ?>" download>Baixar áudio</a>
        <?php elseif (isset($erro)): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
