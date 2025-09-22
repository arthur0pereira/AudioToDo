<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - AudioToDo</title>
</head>
<body>
    <h1>Cadastre-se</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['erro']); ?></p>
    <?php endif; ?>

    <form action="usuario/cadastrar" method="POST">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit">Cadastrar</button>
    </form>

    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
</body>
</html>