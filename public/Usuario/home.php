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
    // posteriormente adicionar validações do texto e voz
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
    <div class="sidebar">
        <h3>Menu</h3>
        <ul>
            <li><a href="/AudioToDo/public/Usuario/perfil.php">Perfil</a></li>
            <li><a href="/AudioToDo/index.php?c=conversao&a=listar">Histórico de Conversões</a></li>
        </ul>
    </div>

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
    </div>
    <a href="/AudioToDo/public/Usuario/login.php">Sair</a>
</body>
</html>
