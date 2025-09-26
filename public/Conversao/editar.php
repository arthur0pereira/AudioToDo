<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$usuario = $_SESSION['usuario'];

// O controller já envia $conversoes para o template
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Conversões</title>
    <link rel="stylesheet" href="editar.css">
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <ul>
            <li><a href="/AudioToDo/public/Usuario/home.php">Home</a></li>
            <li><a href="/AudioToDo/public/Usuario/perfil.php">Perfil</a></li>
        </ul>
    </div>
    <div class="container">
        <h2>Histórico de Conversões</h2>
        <?php if (!empty($conversoes)): ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <tr>
                    <th>ID</th>
                    <th>Texto</th>
                    <th>Voz</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($conversoes as $conv): ?>
                    <tr>
                        <td><?= $conv['id'] ?></td>
                        <td><?= htmlspecialchars($conv['texto']) ?></td>
                        <td><?= htmlspecialchars($conv['voz_utilizada']) ?></td>
                        <td><?= htmlspecialchars($conv['status']) ?></td>
                        <td><?= htmlspecialchars($conv['data_criacao'] ?? '') ?></td>
                        <td>
                            <a href="/AudioToDo/index.php?c=conversao&a=editar&id=<?= $conv['id'] ?>">Editar</a> |
                            <a href="/AudioToDo/index.php?c=conversao&a=excluir&id=<?= $conv['id'] ?>" onclick="return confirm('Excluir esta conversão?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Nenhuma conversão realizada ainda.</p>
        <?php endif; ?>
    </div>
</body>
</html>
