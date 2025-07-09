<?php
require_once 'db-livro.php';

// Get all books from database
$sql = "SELECT * FROM livros ORDER BY titulo ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Livros</title>
   
<body>
    <div class="container">
        <h1>Gerenciamento de Livros</h1>
        
        <?php
        // Show status messages
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            switch($status) {
                case 'success':
                    echo '<div class="alert alert-success">Livro cadastrado/atualizado com sucesso!</div>';
                    break;
                case 'deleted':
                    echo '<div class="alert alert-success">Livro removido com sucesso!</div>';
                    break;
                case 'notfound':
                    echo '<div class="alert alert-error">Livro não encontrado!</div>';
                    break;
                case 'error':
                    echo '<div class="alert alert-error">Ocorreu um erro!</div>';
                    break;
            }
        }
        ?>
        
        <a href="create-livro.php" class="button">Adicionar Novo Livro</a>
        
        <?php if (count($livros) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td><?= htmlspecialchars($livro['autor']) ?></td>
                        <td><?= htmlspecialchars($livro['ano_publicacao']) ?></td>
                        <td class="action-buttons">
                            <a href="update-livro.php?id=<?= $livro['id'] ?>" class="edit-btn">Editar</a>
                            <a href="delete-livro.php?id=<?= $livro['id'] ?>" class="delete-btn" 
                               onclick="return confirm('Tem certeza que deseja remover este livro?')">Remover</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum livro cadastrado ainda.</p>
        <?php endif; ?>
    </div>
</body>
</html>
