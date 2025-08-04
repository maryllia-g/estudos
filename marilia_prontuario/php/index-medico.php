<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todos os médicos
$stmt = $pdo->query("SELECT medicos.*, usuarios.username FROM medicos LEFT JOIN usuarios ON medicos.usuario_id = usuarios.id");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Médicos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Lista de Médicos</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
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
                        <a href="/php/create-consulta.php">Registrar</a> | 
                        <a href="/php/index-consulta.php">Listar</a>
                    </li>
                    <li><a href="/php/logout.php">Logout (<?= $_SESSION['username'] ?>)</a></li>
                <?php else: ?>
                    <li><a href="/php/user-login.php">Login</a></li>
                    <li><a href="/php/user-register.php">Registrar</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>Usuário Associado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicos as $medico): ?>
                    <tr>
                        <td><?= $medico['id'] ?></td>
                        <td><?= $medico['nome'] ?></td>
                        <td><?= $medico['especialidade'] ?></td>
                        <td><?= $medico['username'] ?></td>
                        <td>
                            <a href="read-medico.php?id=<?= $medico['id'] ?>">Visualizar</a>
                            <a href="update-medico.php?id=<?= $medico['id'] ?>">Editar</a>
                            <a href="delete-medico.php?id=<?= $medico['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este médico?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
