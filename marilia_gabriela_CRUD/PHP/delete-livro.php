<?php
require_once 'db-livro.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar se o livro existe antes de deletar
    $sql_verificar = "SELECT id FROM livros WHERE id = :id";
    $stmt_verificar = $pdo->prepare($sql_verificar);
    $stmt_verificar->bindParam(':id', $id);
    $stmt_verificar->execute();

    if ($stmt_verificar->rowCount() > 0) {
        try {
            $sql = "DELETE FROM livros WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            header('Location: index-livro.php?status=deleted');
            exit;
        } catch(PDOException $e) {
            die("Erro ao deletar livro: " . $e->getMessage());
        }
    } else {
        // Livro não encontrado
        header('Location: index-livro.php?status=notfound');
        exit;
    }
} else {
    // ID não foi fornecido
    header('Location: index-livro.php?status=error');
    exit;
}
?>
