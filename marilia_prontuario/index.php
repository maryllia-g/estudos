<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema Saúde</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<header>
    <h1>Sistema de Saúde</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a>|</li> 
            <?php if (isset($_SESSION['user_id'])): ?>
                <li>Pacientes: 
                    <a href="/php/create-paciente.php">Adicionar</a> | 
                    <a href="/php/index-paciente.php">Listar</a>
                </li>
                <li>Médicos: 
                    <a href="/php/create-medico.php">Adicionar</a> | 
                    <a href="/php/index-medico.php">Listar</a>
                </li>
                <li>Consultas: 
                    <a href="/php/create-consulta.php">Adicionar</a> | 
                    <a href="/php/index-consulta.php">Listar</a>
                </li>
                <li><a href="/php/logout.php">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
            <?php else: ?>
                <li><a href="/php/user-login.php">Login</a></li>
                <li>|<a href="/php/user-register.php">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <h2>Bem-vindo ao Sistema de Saúde</h2>
    <p>Utilize o sistema para gerenciar os usuário</p>
</main>

<footer>
    <p>&copy; 2025 - Sistema de Gerenciamento de Saúde</p>
</footer>
</body>
</html>