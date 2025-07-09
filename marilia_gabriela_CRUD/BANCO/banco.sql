-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS livros_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Seleciona o banco de dados
USE livros_db;

-- Criação da tabela de livros
CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    ano_publicacao YEAR NOT NULL
);
