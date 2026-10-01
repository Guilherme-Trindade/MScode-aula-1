<?php

require_once(__DIR__ . '/../../classes/produto.php');

class ProdutoRepository
{
  private string $table = 'mscode.produto';

  public function __construct(
    private PDO $pdo,
  ) {}

  /** @return Produto[] */
  public function buscarTodos(): array
  {
    $sql = <<<SQL
      SELECT id, nome, descricao, preco, categoria, imagem, estoque
        FROM {$this->table}
       ORDER BY id;
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute();

    $produtos = [];
    foreach ($query->fetchAll() as $linha) {
      $produtos[] = $this->criarProduto($linha);
    }

    return $produtos;
  }

  public function buscarPorId(int $id): ?Produto
  {
    $sql = <<<SQL
      SELECT id, nome, descricao, preco, categoria, imagem, estoque
        FROM {$this->table}
       WHERE id = :id;
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute([':id' => $id]);
    $linha = $query->fetch();

    return $linha ? $this->criarProduto($linha) : null;
  }

  public function baixarEstoque(int $id, int $quantidade): bool
  {
    $sql = <<<SQL
      UPDATE {$this->table}
         SET estoque = estoque - :quantidade
       WHERE id = :id AND estoque >= :minimo;
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute([
      ':quantidade' => $quantidade,
      ':id'         => $id,
      ':minimo'     => $quantidade,
    ]);

    return $query->rowCount() === 1;
  }

  private function criarProduto(array $linha): Produto
  {
    return new Produto(
      codigo: (int) $linha['id'],
      nome: $linha['nome'],
      descricao: $linha['descricao'],
      preco: (float) $linha['preco'],
      categoria: $linha['categoria'],
      caminhoImagem: $linha['imagem'],
      quantidade: (int) $linha['estoque']
    );
  }
}
