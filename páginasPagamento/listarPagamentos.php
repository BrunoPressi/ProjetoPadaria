<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/receipt.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pagamentos</title>
</head>
<body>

    <?php

    $codigoVenda = filter_input(INPUT_GET, "var_codigo_venda");
    $idCLiente = filter_input(INPUT_GET, "var_id_cliente");

    ?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Pagamentos da Venda</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo "./pagamentoFormInsert.php? var_codigo_venda=".$codigoVenda."&var_id_cliente=".$idCLiente ?>">Novo Pagamento</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="text" placeholder="Pesquisar Pagamento" aria-label="Search" id="barra_Pesquisa" onkeyup="pesquisar()">
            </form>
          </div>
        </div>
    </nav>
    
    <div class="d-flex justify-content-center">
        <table class="table table-dark table-striped" id="tabela_Clientes">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Valor Pago</th>
                    <th scope="col">Data Pagamento</th>
                    <th scope="col">Forma Pagamento</th>
                    <th scope="col">ID do Cliente</th>
                    <th scope="col">ID da Venda</th>
                    <th scope="col">Editar?</th>
                    <th scope="col">Excluir?</th>
                </tr>
            </thead>   
            <tbody>
                <?php

                ini_set('error_reporting', E_ALL);
                ini_set('display_errors', 1);

                include_once('../conexao.php');
                        
                $conexao = conexaoMYSQL();

                $codigoVenda = filter_input(INPUT_GET, "var_codigo_venda");
                $idCLiente = filter_input(INPUT_GET, "var_id_cliente");

                $query = "SELECT pagamento.id, pagamento.valor_pago, pagamento.data_pagamento, pagamento.forma_pagamento, cliente.id as cliente_id, cliente.nome as nome, venda.codigo as venda_codigo
                          FROM pagamento JOIN venda on pagamento.fk_venda_codigo = venda.codigo 
                          JOIN cliente on pagamento.fk_cliente_id = cliente.id
                          WHERE venda.codigo = $codigoVenda
                          ORDER BY pagamento.id";

                $resultado = mysqli_query($conexao, $query);

                while($i = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $i['id'];?></th>
                    <td scope="row"><?php echo "R$ ".$i['valor_pago'];?></td>
                    <td scope="row"><?php echo $i['data_pagamento'];?></td>
                    <td scope="row"><?php echo $i['forma_pagamento'];?></td>
                    <td scope="row"><?php echo $i['cliente_id']." - ". $i['nome'];?></td>
                    <td scope="row"><?php echo $i['venda_codigo'];?></td>
                    <td scope="row"><a href="<?php echo "./pagamentoFormUpdate.php? var_id=".$i['id']?>">Editar</a></td>
                    <td scope="row"><a href="<?php echo "../operaçõesCRUD/delete.php? var_id=".$i['id']."&tabela=pagamentos"?>">Excluir</a></td>
                </tr>
            </tbody>
                <?php
                } // final while
                ?>
        </table>
    </div>

    <script src="../javascript/main.js"></script>
    <script src="https://kit.fontawesome.com/37c9ce0ae8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>