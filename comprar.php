<?php
require_once(__DIR__ . '/Infra/Connection.php');
require_once(__DIR__ . '/Infra/Repository/ProdutoRepository.php');
require_once(__DIR__ . '/Infra/Repository/PessoaRepository.php');
require_once(__DIR__ . '/classes/canalComunicacao.php');
require_once(__DIR__ . '/classes/whastapp.php');
require_once(__DIR__ . '/classes/compraService.php');


ob_start();

$pdo = null;

try {
    $pdo = Connection::getConnection();

    $produtoId  = (int) ($_GET['id'] ?? 0);
    $clienteId  = 1; 
    $quantidade = 1;

    $produtoRepository = new ProdutoRepository($pdo);
    $pessoaRepository  = new PessoaRepository($pdo);

    $produto = $produtoRepository->buscarPorId($produtoId);
    $cliente = $pessoaRepository->buscarClientePorId($clienteId);

    if ($produto === null) {
        throw new Exception('Produto não encontrado');
    }
    if ($cliente === null) {
        throw new Exception('Cliente não encontrado');
    }

    $pdo->beginTransaction();

    
    $cliente->registrarCompra($produto, $quantidade);

   
    if (!$produtoRepository->baixarEstoque($produtoId, $quantidade)) {
        throw new Exception('Quantidade Insuficiente pra compra');
    }
    $pessoaRepository->adicionarSaldoDevedor($clienteId, $produto->getPreco() * $quantidade);

    $pdo->commit();

    $compraService = new CompraService(new Whatsapp());
    $compraService->finalizarCompra($cliente->getTelefone(), $cliente->getNome());

    ob_end_clean();
    header('Location: clientes.php');
    exit;

} catch (\Throwable $error) {
    if ($pdo !== null && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    ob_end_clean();
    echo $error->getMessage();
}
