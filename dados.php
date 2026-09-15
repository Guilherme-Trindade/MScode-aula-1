<?php 

require_once('./classes/cliente.php');
require_once('./classes/produto.php');

session_start();

$arrayProdutos = [
    [
        'id'        => 1,
        'nome'      => 'Fone de Ouvido Bluetooth Pro',
        'descricao' => 'Som de alta fidelidade com cancelamento ativo de ruído (ANC) e bateria com até 30h de duração.',
        'preco'     => 299.90,
        'categoria' => 'Eletrônicos',
        'imagem'    => 'images/fone.png',
        'estoque'   => 15
    ],
    [
        'id'        => 2,
        'nome'      => 'Smartwatch Sport Fit',
        'descricao' => 'Monitoramento cardíaco 24/7, GPS integrado, tela AMOLED HD e resistência à água (5 ATM).',
        'preco'     => 450.00,
        'categoria' => 'Acessórios',
        'imagem'    => 'images/smartwatch.png',
        'estoque'   => 8
    ],
    [
        'id'        => 3,
        'nome'      => 'Teclado Mecânico RGB',
        'descricao' => 'Switches mecânicos táteis, iluminação RGB personalizável e estrutura durável em alumínio.',
        'preco'     => 389.99,
        'categoria' => 'Periféricos',
        'imagem'    => 'images/teclado.png',
        'estoque'   => 3
    ],
    [
        'id'        => 4,
        'nome'      => 'Mochila Impermeável Tech',
        'descricao' => 'Compartimento acolchoado para notebook de 15.6", saída USB externa e tecido resistente à água.',
        'preco'     => 189.90,
        'categoria' => 'Acessórios',
        'imagem'    => 'images/mochila.png',
        'estoque'   => 9
    ]
];

$produtos = [];
foreach ($arrayProdutos as $arrayProduto) {
    $produto = new Produto(
        $arrayProduto['id'],
        $arrayProduto['nome'],
        $arrayProduto['descricao'],
        $arrayProduto['preco'],
        $arrayProduto['categoria'],
        $arrayProduto['imagem'],
        $arrayProduto['estoque']
    );

      if (!isset($_SESSION['produtos'][$produto->codigo])) {
        $_SESSION['produtos'][$produto->codigo] = $produto;
    }

    $produtos[] = $produto;
}
