<?php
require_once('/var/www/html/MScode-aula-1/' . '/Infra/Repository/PessoaRepository.php');
require_once('/var/www/html/MScode-aula-1/' . '/Infra/Connection.php');
require_once('/var/www/html/MScode-aula-1/' . '/classes/cliente.php');

if (! empty($_POST)) {
  $repository = (new PessoaRepository(
    Connection::getConnection()
));

$pessoa = new Cliente(
    id: null,
    nome: $_POST['nome'],
    telefone: $_POST['telefone'],
    cpf: $_POST['cpf'],
    saldoDevedor: $_POST['saldo_devedor'],
    email: $_POST['email']
);

if ($repository->criarPessoa($pessoa)) {
    return header('Location:http://localhost:9090/MScode-aula-1/clientes.php', true);
}

}
?>