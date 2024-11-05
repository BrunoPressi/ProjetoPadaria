<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imgs/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edição de Produtos</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Edição de Produtos</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="./listarProdutos.php">Produtos</a>
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

    $codigo_produto = filter_input(INPUT_GET, "var_id");

    $query = "SELECT * FROM produto WHERE codigo = {$codigo_produto}";
    $result = mysqli_query($conexao, $query);
    $i = mysqli_fetch_assoc($result);

    ?>
    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/update.php">
            <fieldset>
            <legend class="m-4">Editar Produto</legend>
            <input type="hidden" name="tabela" value="produtos">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" class="form-control" name="produto_codigo" value="<?php echo $i['codigo']?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="produto_nome" placeholder="Preencha com o nome" value="<?php echo $i['nome']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="text" class="form-control" name="produto_preco" value="<?php echo $i['preco']?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input type="text" class="form-control" name="produto_categoria" value="<?php echo $i['categoria'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Quantidade em Estoque</label>
                <input type="text" class="form-control" name="produto_estoque" placeholder="Ex: 2000" value="<?php echo $i['quantidadeEstoque'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar Produto</button>
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