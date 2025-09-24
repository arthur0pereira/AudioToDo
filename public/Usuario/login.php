<?php
session_start();
require_once __DIR__ . "/../../generic/Autoload.php";
require_once __DIR__ . "/../../controller/UsuarioController.php";

use Controller\UsuarioController;


$controller = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $usuario = $controller->login($email, $senha);

    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header("Location: home.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
        <?php if (!empty($erro)): ?>
            <p style="color:red;"><?php echo $erro; ?></p>
        <?php endif; ?>
    <form method="post" action="login.php">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
        <p><a href="form.php">Clique aqui </a>para realizar o cadastro.</p>
    </form>
</body>
</html>
