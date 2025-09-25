<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$conversao = $conversao ?? [];
?>

<h2>Editar Conversão</h2>
<form method="post" action="">
    <label>Texto:</label><br>
    <textarea name="texto" required><?= htmlspecialchars($conversao['texto'] ?? '') ?></textarea><br><br>
    <label>Voz:</label>
    <select name="voz">
        <option value="padrão" <?= ($conversao['voz_utilizada'] ?? '') == 'padrão' ? 'selected' : '' ?>>Padrão</option>
        <option value="masculina" <?= ($conversao['voz_utilizada'] ?? '') == 'masculina' ? 'selected' : '' ?>>Masculina</option>
        <option value="feminina" <?= ($conversao['voz_utilizada'] ?? '') == 'feminina' ? 'selected' : '' ?>>Feminina</option>
    </select><br><br>
    <button type="submit">Salvar</button>
</form>
<p><a href="/AudioToDo/index.php?c=conversao&a=listar">Voltar</a></p>