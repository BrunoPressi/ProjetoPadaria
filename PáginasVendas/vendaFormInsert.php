<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Vendas</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Cadastro de Vendas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="./listarVendas.php">Vendas</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <?php 

    include_once ('../conexao.php');

    $conexao = conexaoMYSQL();

    $query = "SELECT codigo FROM venda ORDER BY codigo DESC LIMIT 1";
    $result = mysqli_query($conexao, $query);
    $i = mysqli_fetch_assoc($result);

    if($i === null) {
        $i['codigo'] = 0;
    }

    $query2 = "SELECT id, nome FROM cliente";
    $result2 = mysqli_query($conexao, $query2);

    $query3 = "SELECT id, nome FROM funcionario WHERE cargo = 'Caixa'";
    $result3 = mysqli_query($conexao, $query3);

    ?>
    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/insert.php">
            <fieldset>
            <legend class="m-4">Cadastrar Venda</legend>
            <input type="hidden" name="tabela" value="venda">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" class="form-control" name="venda_codigo" placeholder="Preencha com o Código" value="<?php echo $i['codigo'] + 1 ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor Total</label>
                <input type="text" class="form-control" name="venda_valor_total" placeholder="Preencha com o valor" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantidade Total</label>
                <input type="text" class="form-control" name="venda_quantidade_total" placeholder="Preencha com o total" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cliente</label>
                <select class="form-select" aria-label="Default select example" name="venda_cliente_id" required>
                    <option disabled selected value="">Selecione o Cliente</option>
                    <?php
                    while($j = mysqli_fetch_assoc($result2)) {
                        // loop do cliente
                    ?>
                    <option value="<?php echo $j['id'];?>"><?php echo $j['id']." - ".$j['nome'];?></option>
                    <?php
                    } // final loop cliente
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Atendente Responsável</label>
                <select class="form-select" aria-label="Default select example" name="venda_funcionario_id" required>
                    <option disabled selected value="">Selecione o Atendente</option>
                    <?php
                    while($k = mysqli_fetch_assoc($result3)) {
                        // loop do funcionário
                    ?>
                    <option value="<?php echo $k['id'];?>"><?php echo $k['id']." - ".$k['nome'];?></option>
                    <?php
                    } // final do loop funcionário
                    ?>
                </select>
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