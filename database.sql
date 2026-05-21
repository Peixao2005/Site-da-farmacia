CREATE DATABASE IF NOT EXISTS farmacia_vav;
USE farmacia_vav;

CREATE TABLE IF NOT EXISTS produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    fabricante VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL
);

INSERT INTO produtos (nome, fabricante, preco, estoque) VALUES
('Dipirona 500mg', 'EMS', 5.90, 120),
('Amoxicilina 500mg', 'Medley', 18.50, 80),
('Vitamina C 1g', 'Cimed', 12.00, 200);
