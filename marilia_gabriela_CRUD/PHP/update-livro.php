<?php
require_once 'db-livro.php';

// Obter dados do livro para edição
if (isset($_GET['id'])) {
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
}

// Processar atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    
    try {
        $sql = "UPDATE livros SET titulo = :titulo, autor = :autor, ano_publicacao = :ano_publicacao, id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':ano_publicacao', $ano_publicacao);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        header('Location: index-livro.php?status=success');
        exit;
    } catch(PDOException $e) {
        die("Erro ao atualizar livro: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
 
</head>
<body>
    <div class="container">
        <div class="edit-container">
            <h1>Editar Livro: <?= htmlspecialchars($livro['titulo']) ?></h1>
            
            <form method="post">
                <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($livro['titulo']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="autor">Autor:</label>
                    <input type="text" id="autor" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="ano_publicacao">Ano de Publicação:</label>
                    <input type="number" id="ano_publicacao" name="ano_publicacao" 
                           value="<?= htmlspecialchars($livro['ano_publicacao']) ?>" 
                           min="1000" max="2099" required>
                </div>
                
                <div class="buttons">
                    <button type="submit" class="btn btn-save">Salvar Alterações</button>
                    <a href="index-livro.php" class="btn btn-cancel">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
