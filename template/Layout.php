<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? "AudioToDo" ?></title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
            width: 220px;
            background: #333;
            color: #fff;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar h2 {
            margin-top: 0;
            color: #ffcc00;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #555;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>AudioToDo</h2>
        <a href="index.php?c=conversao&a=listar">Conversões</a>
        <a href="index.php?c=usuario&a=form">Perfil</a>
        <a href="index.php?c=usuario&a=logout">Sair</a>
    </div>
    <div class="content">
        <?= $conteudo ?>
    </div>
</body>
</html>
