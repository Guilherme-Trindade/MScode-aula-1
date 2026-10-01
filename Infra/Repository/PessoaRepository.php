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

  public function buscarClientePorId(int $id): ?Cliente
  {
    $sql = <<<SQL
      SELECT * FROM {$this->table} WHERE id = :id;
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute([':id' => $id]);
    $pessoa = $query->fetch();

    if (!$pessoa) {
      return null;
    }

    return new Cliente(
      id: (int) $pessoa['id'],
      nome: $pessoa['nome'],
      telefone: $pessoa['telefone'],
      email: $pessoa['email'],
      cpf: $pessoa['cpf'],
      saldoDevedor: (float) $pessoa['saldo_devedor']
    );
  }

  public function adicionarSaldoDevedor(int $id, float $valor): void
  {
    $sql = <<<SQL
      UPDATE {$this->table}
         SET saldo_devedor = saldo_devedor + :valor
       WHERE id = :id;
    SQL;

    $query = $this->pdo->prepare($sql);
    $query->execute([':valor' => $valor, ':id' => $id]);
  }
}

?>
