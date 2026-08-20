CREATE DATABASE crud_aula;

USE crud_aula;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO usuarios (nome, email) VALUES
('João Silva', 'joao@gmail.com'),
('Maria Santos', 'maria@gmail.com'),
('Pedro Oliveira', 'pedro@gmail.com');