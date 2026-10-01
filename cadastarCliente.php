<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0 py-2">Nova Inclusão - Perfil e Crédito</h5>
                </div>
                <div class="card-body p-4">
                    <form id="formCadastroPessoa" method="POST"  action="./Service/salvarPessoa.php">
                        <div class="row g-3">
                            <div class="col-md-7">
                                <label for="nome" class="form-label fw-medium">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João da Silva" required>
                            </div>
                            
                            <div class="col-md-5">
                                <label for="cpf" class="form-label fw-medium">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-medium">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="joao@exemplo.com">
                            </div>

                            <div class="col-md-6">
                                <label for="telefone" class="form-label fw-medium">Telefone</label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000">
                            </div>

                            <div class="col-12 mt-4">
                                <hr class="text-muted">
                            </div>

                            <div class="col-md-4">
                                <label for="saldo_devedor" class="form-label fw-bold text-danger">Saldo Devedor (R$)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">R$</span>
                                    <input type="text" class="form-control text-end" id="saldo_devedor" name="saldo_devedor" placeholder="0,00">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" class="btn btn-outline-secondary me-2">Cancelar</button>
                            <button type="submit" class="btn btn-primary px-4">Salvar Registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>