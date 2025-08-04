<?php
require_once 'db.php';
require_once 'authenticate.php';

// Verifica se os parâmetros necessários estão presentes
if (!isset($_GET['id_medico']) || !isset($_GET['id_paciente']) || !isset($_GET['data_hora'])) {
    header('Location: index-consulta.php?error=Parâmetros incompletos para exclusão');
    exit;
}

$id_medico = $_GET['id_medico'];
$id_paciente = $_GET['id_paciente'];
$data_hora = $_GET['data_hora'];

try {
    // Prepara e executa a exclusão da consulta
    $stmt = $pdo->prepare("DELETE FROM consulta WHERE id_medico = ? AND id_paciente = ? AND data_hora = ?");
    $stmt->execute([$id_medico, $id_paciente, $data_hora]);

    // Verifica se alguma consulta foi realmente excluída
    if ($stmt->rowCount() === 0) {
        header('Location: index-consulta.php?error=Consulta não encontrada');
        exit;
    }

    header('Location: index-consulta.php?success=Consulta cancelada com sucesso');
} catch (PDOException $e) {
    // Log do erro pode ser implementado aqui
    header('Location: index-consulta.php?error=Erro ao cancelar consulta');
}
exit;
?>
