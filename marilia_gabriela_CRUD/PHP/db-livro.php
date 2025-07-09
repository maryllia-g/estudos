<?php
$host = 'localhost:3308';
$dbname = 'livros_db';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurar para retornar arrays associativos por padrão
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Função auxiliar para sanitizar dados (segurança contra SQL Injection)
function sanitize($data) {
    global $pdo;
    return htmlspecialchars(strip_tags($data));
}
?>

