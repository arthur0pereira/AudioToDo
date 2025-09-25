<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$usuario = $_SESSION['usuario'];
?>

<h2>Meu Perfil</h2>
<form method="post" action="/AudioToDo/index.php?c=usuario&a=atualizar">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>
    <label>Nova Senha:</label><br>
    <input type="password" name="senha" placeholder="Digite uma nova senha"><br><br>
    <button type="submit">Salvar Alterações</button>
</form>

<form method="post" action="/AudioToDo/index.php?c=usuario&a=excluir" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
    <button type="submit" style="background:red;color:white;">Excluir Conta</button>
</form>
<p><a href="home.php">Voltar para a Home</a></p>
