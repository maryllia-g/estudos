<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona a consulta específica pelo ID
$stmt = $pdo->prepare("
    SELECT consultas.*, medicos.nome AS medico_nome, pacientes.nome AS paciente_nome 
    FROM consultas 
    LEFT JOIN medicos ON consultas.id_medico = medicos.id 
    LEFT JOIN pacientes ON consultas.id_paciente = pacientes.id 
    WHERE consultas.id = ?
");
$stmt->execute([$id]);
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

// Obter todos os médicos e pacientes para associar à consulta
$stmt = $pdo->query("SELECT id, nome FROM medicos");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT id, nome FROM pacientes");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medico_id = $_POST['medico_id'];
    $paciente_id = $_POST['paciente_id'];
    $data_hora = $_POST['data_hora'];

    // Atualiza a consulta no banco de dados
    $stmt = $pdo->prepare("UPDATE consultas SET id_medico = ?, id_paciente = ?, data_hora = ? WHERE id = ?");
    $stmt->execute([$medico_id, $paciente_id, $data_hora, $id]);

    header('Location: read-consulta.php?id=' . $id);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Editar Consulta</h1>
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
        <form method="POST">
            <label for="medico_id">Médico:</label>
            <select id="medico_id" name="medico_id" required>
                <option value="">Selecione o médico</option>
                <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico['id'] ?>" <?= $medico['id'] == $consulta['id_medico'] ? 'selected' : '' ?>>
                        <?= $medico['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="paciente_id">Paciente:</label>
            <select id="paciente_id" name="paciente_id" required>
                <option value="">Selecione o paciente</option>
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id'] ?>" <?= $paciente['id'] == $consulta['id_paciente'] ? 'selected' : '' ?>>
                        <?= $paciente['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="data_hora">Data/Hora:</label>
            <input type="datetime-local" id="data_hora" name="data_hora" value="<?= date('Y-m-d\TH:i', strtotime($consulta['data_hora'])) ?>" required>

            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>
