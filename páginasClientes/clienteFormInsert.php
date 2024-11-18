<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Clientes</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Cadastro de Clientes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="./listarClientes.php">Clientes</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <?php 

    include_once ('../conexao.php');

    $conexao = conexaoMYSQL();

    $query = "SELECT id FROM cliente ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conexao, $query);
    $i = mysqli_fetch_assoc($result);

    if($i === null ) {
        $i['id'] = 0;
    }

    ?>
    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/insert.php">
            <fieldset>
            <legend class="m-4">Cadastrar Cliente</legend>
            <input type="hidden" name="tabela" value="cliente">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="text" class="form-control" name="cliente_id" placeholder="Preencha com o ID" value="<?php echo $i['id'] + 1;?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="cliente_nome" placeholder="Preencha com o nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" name="cliente_cpf" pattern="^\d{3}\.\d{3}\.\d{3}-\d{2}$" placeholder="000.000.000-00" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control" name="cliente_telefone" pattern="^\(\d{2}\) \d{5}-\d{4}$" placeholder="(99) 99999-9999" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
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