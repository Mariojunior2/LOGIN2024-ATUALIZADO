<?php
session_start();
require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $_SESSION['error'] = 'Preencha todos os campos!';
    } elseif ($senha !== $confirmar_senha) {
        $_SESSION['error'] = 'As senhas não coincidem!';
    } else {

        $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        if ($stmt->execute([$nome, $email, $senha])) {
            $_SESSION['success'] = 'Usuário registrado com sucesso! Você pode fazer login agora.';
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['error'] = 'Erro ao registrar usuário!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="registro">
    <h2>REGISTRO</h2>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'>{$_SESSION['success']}</p>";
        unset($_SESSION['success']);
    }
    ?>
    <form action="register.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <label for="confirmar_senha">Confirmar Senha:</label><br>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required><br><br>

        <button type="submit">Registrar</button>
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
    </div>
</body>
</html>

