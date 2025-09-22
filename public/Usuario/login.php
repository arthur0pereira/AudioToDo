<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AudioToDo</title>
</head>
<body>
    <h1>Login</h1>

    <?php 
        // Exibe mensagens de sucesso ou erro vindas do controller
        if (isset($_GET['mensagem'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($_GET['mensagem']); ?></p>
        <?php endif; 
        if (isset($_GET['erro'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_GET['erro']); ?></p>
        <?php endif; 
    ?>

    <form action="/usuario/login" method="POST">
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit">Entrar</button>
    </form>

    <p>Não tem uma conta? <a href="cadastrar.php">Cadastre-se aqui</a></p>
</body>
</html>