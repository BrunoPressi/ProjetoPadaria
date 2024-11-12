<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro de Pagamentos</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Registro de Pagamentos</a>
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

    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);

    include_once ('../conexao.php');

    $conexao = conexaoMYSQL();

    $query = "SELECT id FROM pagamento ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conexao, $query);
    $i = mysqli_fetch_assoc($result);

    if($i === null) {
        $i['id'] = 0;
    }

    $codigoVenda = filter_input(INPUT_GET, "var_codigo_venda");
    $idCLiente = filter_input(INPUT_GET, "var_id_cliente");

    $query2 = "SELECT cliente.id as id, venda.codigo as codigo, venda.valor_total as valor_total
               FROM cliente JOIN venda ON venda.fk_cliente_id = cliente.id
               WHERE venda.codigo = $codigoVenda";

    $resultado2 = mysqli_query($conexao, $query2);
    $j = mysqli_fetch_assoc($resultado2);

    ?>
    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/insert.php">
            <fieldset>
            <legend class="m-4">Registrar Pagamento</legend>
            <input type="hidden" name="tabela" value="pagamento">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="text" class="form-control" name="pagamento_id" placeholder="Preencha com o ID" value="<?php echo $i['id'] + 1?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor Pago</label>
                <input type="text" class="form-control" name="pagamento_valorTotal" placeholder="Preencha com o valor pago" value="<?php echo $j['valor_total'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Data do Pagamento</label>
                <input type="date" class="form-control" name="pagamento_data" placeholder="Preencha com a data" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Forma Pagamento</label>
                <select class="form-select" aria-label="Default select example" name="pagamento_forma" required>
                    <option disabled selected value="">Selecione a forma de pagamento</option>
                    <option value="cartão">Cartão</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="pix">PIX</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">ID do Cliente:</label>
                <input type="text" class="form-control" name="pagamento_codigo_cliente" value="<?php echo $j['id']?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Código da Venda</label>
                <input type="text" class="form-control" name="pagamento_codigo_venda" value="<?php echo $j['codigo']?>"required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Pagamento</button>
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