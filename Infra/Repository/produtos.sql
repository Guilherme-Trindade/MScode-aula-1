-- Rode este script UMA vez no MySQL Workbench (raio para executar).
-- O nome do banco (mscode) ja esta na frente da tabela, entao nao precisa selecionar nada.

CREATE TABLE IF NOT EXISTS mscode.produto (
    id        INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    nome      VARCHAR(120)  NOT NULL,
    descricao TEXT          NOT NULL,
    preco     DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(60)   NOT NULL,
    imagem    VARCHAR(255)  NOT NULL,
    estoque   INT UNSIGNED  NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Os 4 produtos que hoje estao "fixos" no dados.php
INSERT INTO mscode.produto (id, nome, descricao, preco, categoria, imagem, estoque) VALUES
(1, 'Fone de Ouvido Bluetooth Pro',
    'Som de alta fidelidade com cancelamento ativo de ruído (ANC) e bateria com até 30h de duração.',
    299.90, 'Eletrônicos', 'images/fone.png', 15),
(2, 'Smartwatch Sport Fit',
    'Monitoramento cardíaco 24/7, GPS integrado, tela AMOLED HD e resistência à água (5 ATM).',
    450.00, 'Acessórios', 'images/smartwatch.png', 8),
(3, 'Teclado Mecânico RGB',
    'Switches mecânicos táteis, iluminação RGB personalizável e estrutura durável em alumínio.',
    389.99, 'Periféricos', 'images/teclado.png', 3),
(4, 'Mochila Impermeável Tech',
    'Compartimento acolchoado para notebook de 15.6", saída USB externa e tecido resistente à água.',
    189.90, 'Acessórios', 'images/mochila.png', 9);
