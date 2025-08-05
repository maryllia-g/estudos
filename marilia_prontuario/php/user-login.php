<?php
require_once 'db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /index.php');
        exit();
    } else {
        $error = "Nome de usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Sistema Clínica</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
<header>
    <h1>Bem-vindo ao Sistema Clínica</h1>
    <nav>
        <ul>
            <li><a href="/index.php">Home</a>|</li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/php/index-paciente.php">Pacientes</a></li>
                <li><a href="/php/index-medico.php">Médicos</a></li>
                <li><a href="/php/index-consulta.php">Consultas</a></li>
                <li><a href="/php/logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
            <?php else: ?>
                <li><a href="/php/user-login.php">Login</a></li>
                <li>|<a href="/php/user-register.php">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required />
        
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required />
        
        <button type="submit">Login</button>
    </form>
</main>
</body>
</html>