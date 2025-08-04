<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todas as consultas
$stmt = $pdo->query("
    SELECT consultas.*, 
           medicos.nome AS medico_nome, 
           pacientes.nome AS paciente_nome 
    FROM consultas 
    LEFT JOIN medicos ON consultas.id_medico = medicos.id 
    LEFT JOIN pacientes ON consultas.id_paciente = pacientes.id
");
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Consultas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Lista de Consultas</h1>
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
                    <th>Médico</th>
                    <th>Paciente</th>
                    <th>Data/Hora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <td><?= $consulta['id'] ?></td>
                        <td><?= $consulta['medico_nome'] ?></td>
                        <td><?= $consulta['paciente_nome'] ?></td>
                        <td><?= $consulta['data_hora'] ?></td>
                        <td>
                            <a href="read-consulta.php?id=<?= $consulta['id'] ?>">Visualizar</a>
                            <a href="update-consulta.php?id=<?= $consulta['id'] ?>">Editar</a>
                            <a href="delete-consulta.php?id_medico=<?= $consulta['id_medico'] ?>&id_paciente=<?= $consulta['id_paciente'] ?>&data_hora=<?= $consulta['data_hora'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta consulta?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
