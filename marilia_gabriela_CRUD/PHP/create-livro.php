<?php
require_once 'db-livro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano_publicacao = $_POST['ano_publicacao'];
    
    
    try {
        $sql = "INSERT INTO livros (titulo, autor, ano_publicacao) VALUES (:titulo, :autor, :ano_publicacao)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':ano_publicacao', $ano_publicacao);
     
        $stmt->execute();
        
        header('Location: index-livro.php?status=success');
        exit;
    } catch(PDOException $e) {
        echo "Erro ao criar livro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Livro</title>
    
</head>
<body>
    <div class="container">
        <h1>Adicionar Novo Livro</h1>
        <form method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required>
            
            <label for="ano_publicacao">Ano de Publicação:</label>
            <input type="number" id="ano_publicacao" name="ano_publicacao" required min="1000" max="2099">
            
            <button type="submit">Adicionar Livro</button>
        </form>
        <a class="button" href="index-livro.php">Voltar para Lista</a>
    </div>
</body>
</html>

