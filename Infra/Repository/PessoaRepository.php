<?php

require_once(__DIR__ . '/../../classes/cliente.php');

class PessoaRepository
{
  private string $table = 'mscode.pessoa';

  public function __construct(
    private PDO $pdo,
  ) {}

  public function criarPessoa(Pessoa $pessoa): void
  {
    $sql = <<<SQL
      INSERT INTO {$this->table} ()
    SQL;
  }

  public function buscarTodosUsuarios(): array
  {
    $sql = <<<SQL
      SELECT * FROM {$this->table};
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute();
    
    $usuarios = [];
    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $pessoa) {
      $usuarios[] = new Cliente(
        id: (int) $pessoa['id'],
        nome: $pessoa['nome'],
        telefone: $pessoa['telefone'],
        cpf: $pessoa['cpf'],
        saldoDevedor: (float) $pessoa['saldo_devedor'],
        email: $pessoa['email']
      );
    }

    return $usuarios;
  }

  public function buscarClienteSaldoMenor10()
  {
    $sql = <<<SQL
      SELECT * FROM {$this->table} WHERE saldo_devedor < 10;
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute();

    $usuarios = [];
    foreach($query->fetchAll(PDO::FETCH_ASSOC) as $pessoa) {
      $usuarios[] = new Cliente(
        id: (int) $pessoa['id'],
        nome: $pessoa['nome'],
        telefone: $pessoa['telefone'],
        cpf: $pessoa['cpf'],
        saldoDevedor: (float) $pessoa['saldo_devedor'],
        email: $pessoa['email']
      );
    }

    return $usuarios;
  }
}

?>
