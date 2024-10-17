<?php
session_start();
require_once 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        echo 'Preencha todos os campos!';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if ($senha === $usuario['senha']) {
        
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                header('Location: dashboard.php');
                exit();
            } else {
                echo 'Email ou senha incorretos!';
            }
        } else {
            echo 'Email ou senha incorretos!';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
    <h1>LOGIN</h1>
    <?php
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'>{$_SESSION['success']}</p>";
        unset($_SESSION['success']);
    }
    ?>
    <form action="login.php" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha" id="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>
    <p>Não tem uma conta? <a href="register.php">Registre-se aqui</a>.</p>
    </div>
</body>
</html>


