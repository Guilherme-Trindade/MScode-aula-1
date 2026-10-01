<?php

require_once(__DIR__ . '../../../classes/cliente.php');

class PessoaRepository
{
  private string $table = 'mscode.pessoa';

  public function __construct(
    private PDO $pdo,
  ) {}

  public function criarPessoa(Cliente $pessoa): bool
  {
    $sql = <<<SQL
      INSERT INTO {$this->table} (
          nome,
          telefone,
          cpf,
          email,
          saldo_devedor
          ) VALUES (
          :nome,
          :telefone,
          :cpf,
          :email,
          :saldoDevedor
      );
    SQL;

    $insert = $this->pdo->prepare($sql);
    $insert->execute([
      'nome' => $pessoa->getNome(),
      'telefone' => $pessoa->getTelefone(),
      'cpf' => $pessoa->getCpf(),
      'email' => $pessoa->getEmail(),
      'saldoDevedor' => $pessoa->getSaldoDevedor()
    ]);

    return true;
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
