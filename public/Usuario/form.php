<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form method="post" action="index.php?c=usuario&a=salvar">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Cadastrar</button>

        <p>Já possui conta? <a href="/AudioToDo/public/Usuario/login.php">Clique aqui para logar</a></p>
    </form>
</body>
</html>
