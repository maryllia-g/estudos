<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

// Obtém o ID do paciente a ser excluído a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para excluir o paciente pelo ID
$stmt = $pdo->prepare("DELETE FROM paciente WHERE id = ?");

// Executa a instrução SQL com o ID do paciente
$stmt->execute([$id]);

// Redireciona para a página de listagem de pacientes após a exclusão
header('Location: index-paciente.php');
exit;
?>
