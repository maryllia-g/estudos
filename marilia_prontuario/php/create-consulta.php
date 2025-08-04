<?php
require_once 'db.php';
require_once 'authenticate.php';

// Obter todos os médicos para associar à consulta
$stmt = $pdo->query("SELECT id, nome FROM medico");
$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter todos os pacientes para associar à consulta
$stmt = $pdo->query("SELECT id, nome FROM paciente");
$pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_medico = $_POST['id_medico'];
    $id_paciente = $_POST['id_paciente'];
    $data_hora = $_POST['data_hora'];
    $observacoes = $_POST['observacoes'];

    // Insere a nova consulta no banco de dados
    $stmt = $pdo->prepare("INSERT INTO consulta (id_medico, id_paciente, data_hora, observacoes) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_medico, $id_paciente, $data_hora, $observacoes]);

    header('Location: index-consulta.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Adicionar Consulta</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>Médicos: 
                        <a href="/php/create-medico.php">Adicionar</a> | 
                        <a href="/php/index-medico.php">Listar</a>
                    </li>
                    <li>Pacientes: 
                        <a href="/php/create-paciente.php">Adicionar</a> | 
                        <a href="/php/index-paciente.php">Listar</a>
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
            <label for="id_medico">Médico:</label>
            <select id="id_medico" name="id_medico" required>
                <option value="">Selecione o médico</option>
                <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico['id'] ?>"><?= $medico['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="id_paciente">Paciente:</label>
            <select id="id_paciente" name="id_paciente" required>
                <option value="">Selecione o paciente</option>
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['id'] ?>"><?= $paciente['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="data_hora">Data e Hora:</label>
            <input type="datetime-local" id="data_hora" name="data_hora" required>

            <label for="observacoes">Observações:</label>
            <textarea id="observacoes" name="observacoes"></textarea>

            <button type="submit">Adicionar</button>
        </form>
    </main>
</body>
</html>
