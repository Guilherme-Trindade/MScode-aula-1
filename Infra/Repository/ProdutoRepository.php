<?php

require_once(__DIR__ . '/../../classes/produto.php');

class ProdutoRepository
{
  private string $table = 'mscode.produto';

  public function __construct(
    private PDO $pdo,
  ) {}

  // public function criarProduto(Produto $produto): void
  // {
  //  $sql = <<<SQL
  //    INSERT INTO {$this->table} ()
  //  SQL;
  //}

  public function buscarTodosProdutos(): array
  {
    $sql = <<<SQL
      SELECT * FROM {$this->table};
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute();
    
    $produtos = [];
    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $produto) {
      $produtos[] = new Produto(
        id: (int) $produto['id'],
        nome: $produto['nome'],
        descricao: $produto['descricao'],
        preco: (float) $produto['preco'],
        categoria: $produto['categoria'],
        imagem: $produto['imagem'],
        estoque: (int) $produto['estoque']
      );
    }

    return $produtos;
  }
}

?>
