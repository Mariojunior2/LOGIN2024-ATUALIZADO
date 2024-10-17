<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header(header: 'Location: login.php');
    exit();
}

$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : 'nome';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard">
    <h2>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h2>
    <br>
    <h3>ULTIMAS NOTICIAS</h3>
    <p>VOCÊ É LINDO OU LINDA!!!!</p>
    <a href='logout.php'>Sair</a>
</div>
</body>
</html>


