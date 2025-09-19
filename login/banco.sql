CREATE DATABASE usuario;
USE usuario;

CREATE TABLE usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome varchar(100),
    email varchar(150),
    senha varchar(32)
);

INSERT INTO usuario SET nome = 'admin', senha = '123', email = 'admin@gmail.com';