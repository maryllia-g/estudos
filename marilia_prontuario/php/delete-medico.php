<?php
require_once 'db.php';
require_once 'authenticate.php';

// Verifica se o ID do médico foi fornecido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index-medico.php?error=ID inválido');
    exit;
}

$id = $_GET['id'];

try {
    // Verifica se o médico tem consultas agendadas
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM consulta WHERE id_medico = ?");
    $stmt->execute([$id]);
    $hasConsultas = $stmt->fetchColumn();

    if ($hasConsultas > 0) {
        header('Location: index-medico.php?error=Não é possível excluir médico com consultas agendadas');
        exit;
    }

    // Prepara e executa a exclusão do médico
    $stmt = $pdo->prepare("DELETE FROM medico WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: index-medico.php?success=Médico excluído com sucesso');
} catch (PDOException $e) {
    header('Location: index-medico.php?error=Erro ao excluir médico');
}
exit;
?>
