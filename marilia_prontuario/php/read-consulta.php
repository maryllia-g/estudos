<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona a consulta específica pelo ID
$stmt = $pdo->prepare("
    SELECT consultas.*, 
           medicos.nome AS medico_nome, 
           pacientes.nome AS paciente_nome 
    FROM consultas 
    LEFT JOIN medicos ON consultas.id_medico = medicos.id 
    LEFT JOIN pacientes ON consultas.id_paciente = pacientes.id 
    WHERE consultas.id = ?
");
$stmt->execute([$id]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

// Manipulação da consulta
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['cancelar'])) {
        $stmt = $pdo->prepare("DELETE FROM consultas WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index-consulta.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Detalhes da Consulta</h1>
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
        <?php if ($consulta): ?>
            <p><strong>ID:</strong> <?= $consulta['id'] ?></p>
            <p><strong>Médico:</strong> <?= $consulta['medico_nome'] ?></p>
            <p><strong>Paciente:</strong> <?= $consulta['paciente_nome'] ?></p>
            <p><strong>Data/Hora:</strong> <?= $consulta['data_hora'] ?></p>

            <h2>Cancelar Consulta</h2>
            <form method="POST">
                <button type="submit" name="cancelar">Cancelar Consulta</button>
            </form>

            <p>
                <a href="update-consulta.php?id=<?= $consulta['id'] ?>">Editar</a>
                <a href="delete-consulta.php?id_medico=<?= $consulta['id_medico'] ?>&id_paciente=<?= $consulta['id_paciente'] ?>&data_hora=<?= $consulta['data_hora'] ?>">Excluir</a>
            </p>
        <?php else: ?>
            <p>Consulta não encontrada.</p>
        <?php endif; ?>
    </main>
</body>
</html>
