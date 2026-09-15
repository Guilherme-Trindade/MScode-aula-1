<?php

require_once(__DIR__ . '../../../classes/cliente.php');

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
    foreach($query->fetchAll() as $pessoa) {
      $usuarios[] = new Cliente(
        id: $pessoa['id'],
        nome: $pessoa['nome'],
        telefone: $pessoa['telefone'],
        email: $pessoa['email'],
        cpf: $pessoa['cpf'],
        saldoDevedor: $pessoa['saldo_devedor']
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
    foreach($query->fetchAll() as $pessoa) {
      $usuarios[] = new Cliente(
        id: $pessoa['id'],
        nome: $pessoa['nome'],
        telefone: $pessoa['telefone'],
        email: $pessoa['email'],
        cpf: $pessoa['cpf'],
        saldoDevedor: $pessoa['saldo_devedor']
      );
    }

    return $usuarios;
  }
}

?>
