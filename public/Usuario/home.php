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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home - Conversor</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($usuario['nome']); ?>!</h2>

    <form method="post">
        <textarea name="texto" rows="5" cols="40" placeholder="Digite o texto para converter"></textarea><br><br>
        <button type="submit">Converter para áudio</button>
    </form>

    <?php if (!empty($linkAudio)): ?>
        <p>Arquivo gerado: <a href="<?php echo $linkAudio; ?>" download>Baixar áudio</a></p>
    <?php endif; ?>

    <p><a href="logout.php">Sair</a></p>
</body>
</html>
