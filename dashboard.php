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
    <h2>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h2>
    <br>
    <a href='logout.php'>Sair</a>
</body>
</html>


