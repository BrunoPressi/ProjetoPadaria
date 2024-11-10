<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edição de Pagamentos</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Edição de Pagamentos</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="../PáginasVendas/listarVendas.php">Vendas</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <?php 

    include_once ('../conexao.php');

    $conexao = conexaoMYSQL();

    $id_pagamento = filter_input(INPUT_GET, "var_id");

    $query = "SELECT * FROM pagamento WHERE id = $id_pagamento";

    $query2 = "SELECT cliente.nome AS nome FROM cliente JOIN pagamento ON cliente.id = pagamento.fk_cliente_id WHERE pagamento.id = $id_pagamento";

    $result = mysqli_query($conexao, $query);
    $i = mysqli_fetch_assoc($result);

    $result2 = mysqli_query($conexao, $query2);
    $j = mysqli_fetch_assoc($result2);

    if($i === null) {
        $i['codigo'] = 0;
    }

    ?>
    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/update.php">
            <fieldset>
            <legend class="m-4">Editar Pagamento</legend>
            <input type="hidden" name="tabela" value="pagamentos">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="text" class="form-control" name="pagamento_id" placeholder="Preencha com o ID" value="<?php echo $i['id']?>" required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor Pago</label>
                <input type="text" class="form-control" name="pagamento_valor_pago" placeholder="Preencha com o valor pago" value="<?php echo $i['valor_pago']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Data do Pagamento</label>
                <input type="date" class="form-control" name="pagamento_data" placeholder="Preencha com a data do pagamento" value="<?php echo $i['data_pagamento']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Forma do Pagamento</label>
                <select class="form-select" aria-label="Default select example" name="pagamento_forma" required>
                    <option <?php echo $i['forma_pagamento']?>>Selecione a forma de pagamento</option>
                    <option value="cartão">Cartão</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="pix">Pix</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">ID do Cliente - <?php echo $j['nome'] ?></label>
                <input type="text" class="form-control" name="pagamento_cliente" placeholder="Preencha com o nome do cliente que pagou" value="<?php echo $i['fk_cliente_id']?>" readonly required>
            </div>
            <div class="mb-3">
                <label class="form-label">Código da Venda</label>
                <input type="text" class="form-control" name="pagamento_codigo_venda" placeholder="Preencha com a data do pagamento" value="<?php echo $i['fk_venda_codigo']?>" readonly required>
            </div>
            <button type="submit" class="btn btn-primary">Editar pagamento</button>
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