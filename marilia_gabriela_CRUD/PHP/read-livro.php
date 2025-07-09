<?php
require_once 'db-livro.php';

if (!isset($_GET['id'])) {
    header('Location: index-livro.php?status=error');
    exit;
}

$id = $_GET['id'];

try {
    $sql = "SELECT * FROM livros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    $livro = $stmt->fetch();
    
    if (!$livro) {
        header('Location: index-livro.php?status=notfound');
        exit;
    }
} catch(PDOException $e) {
    die("Erro ao buscar livro: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Livro - <?= htmlspecialchars($livro['titulo']) ?></title>
    
</head>
<body>
    <div class="container">
        <div class="book-details">
            <h1><?= htmlspecialchars($livro['titulo']) ?></h1>
            
            <div class="book-detail">
                <span class="detail-label">Autor:</span>
                <span class="detail-value"><?= htmlspecialchars($livro['autor']) ?></span>
            </div>
            
            <div class="book-detail">
                <span class="detail-label">Ano de Publicação:</span>
                <span class="detail-value"><?= htmlspecialchars($livro['ano_publicacao']) ?></span>
            </div>
            
            <div class="action-buttons">
                <a href="update-livro.php?id=<?= $livro['id'] ?>" class="btn btn-edit">Editar Livro</a>
                <a href="index-livro.php" class="btn btn-back">Voltar para Lista</a>
            </div>
        </div>
    </div>
</body>
</html>
