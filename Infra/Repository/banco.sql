CREATE DATABASE IF NOT EXISTS mscode
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS mscode.pessoa (
    id            INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    nome          VARCHAR(120)  NOT NULL,
    telefone      VARCHAR(20)   NOT NULL,
    email         VARCHAR(120)  NOT NULL,
    cpf           VARCHAR(14)   NOT NULL,
    saldo_devedor DECIMAL(10,2) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO mscode.pessoa (id, nome, telefone, email, cpf, saldo_devedor) VALUES
(1, 'Ana Souza',    '27999990001', 'ana@exemplo.com',    '111.111.111-11',   0.00),
(2, 'Bruno Lima',   '27999990002', 'bruno@exemplo.com',  '222.222.222-22',   5.50),
(3, 'Carla Mendes', '27999990003', 'carla@exemplo.com',  '333.333.333-33', 120.00);
