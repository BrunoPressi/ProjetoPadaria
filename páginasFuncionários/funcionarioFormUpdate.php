<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edição de Funcionários</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Edição de Funcionários</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="./listarFuncionarios.php">Funcionários</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Produtos</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <?php

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);

    include_once('../conexao.php');

    $conexao = conexaoMYSQL();

    $funcionario_id = filter_input(INPUT_GET, "var_id");

    $query = "SELECT * FROM funcionario WHERE id = {$funcionario_id}";
    $result = mysqli_query($conexao, $query);
    $i = mysqli_fetch_assoc($result);

    ?>
    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/update.php">
            <fieldset>
            <legend class="m-4">Editar Funcionário</legend>
            <input type="hidden" name="tabela" value="funcionario">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="text" class="form-control" name="funcionario_id" value="<?php echo $i['id']?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="funcionario_nome" placeholder="Preencha com o nome" value="<?php echo $i['nome']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" name="funcionario_cpf" pattern="^\d{3}\.\d{3}\.\d{3}-\d{2}$" placeholder="000.000.000-00" value="<?php echo $i['cpf']?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control" name="funcionario_telefone" pattern="^\(\d{2}\) \d{5}-\d{4}$" placeholder="(99) 99999-9999" value="<?php echo $i['telefone'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Salário</label>
                <input type="text" class="form-control" name="funcionario_salario" pattern="^\d+(\.\d{1,2})?$" placeholder="Ex: 2000" value="<?php echo $i['salario'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Cargo</label>
                <input type="text" class="form-control" name="funcionario_cargo" placeholder="Ex: Atendente" value="<?php echo $i['cargo'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar Funcionário</button>
            </fieldset>
        </form>
    </div>

    <script src="../javascript/main.js"></script>
    <script src="https://kit.fontawesome.com/37c9ce0ae8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>