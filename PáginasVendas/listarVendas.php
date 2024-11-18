<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/receipt.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Vendas</title>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand">Lista de Vendas</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="./vendaFormInsert.php">Nova Venda</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="text" placeholder="Pesquisar Venda" aria-label="Search" id="barra_Pesquisa" onkeyup="pesquisar()">
            </form>
          </div>
        </div>
    </nav>
    
    <div class="d-flex justify-content-center">
        <table class="table table-dark table-striped" id="tabela_Clientes">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Valor Total</th>
                    <th scope="col">Quantidade Total de Itens</th>
                    <th scope="col">ID do Cliente</th>
                    <th scope="col">ID do Atendente</th>
                    <th scope="col">Itens da Venda</th>
                    <th scope="col">Pagamento</th>
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

                $query = "SELECT *, cliente.nome AS nome, funcionario.nome AS nomeFunc 
                          FROM venda JOIN cliente ON cliente.id = fk_cliente_id 
                          JOIN funcionario ON funcionario.id = fk_funcionario_id
                          ORDER BY venda.codigo";
                $resultado = mysqli_query($conexao, $query);

                while($i = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $i['codigo'];?></th>
                    <td scope="row"><?php echo "R$ ".$i['valor_total'];?></td>
                    <td scope="row"><?php echo $i['quantidade_total'];?></td>
                    <td scope="row"><?php echo $i['fk_cliente_id']." - ".$i['nome'];?></td>
                    <td scope="row"><?php echo $i['fk_funcionario_id']." - ".$i['nomeFunc'];?></td>
                    <td scope="row"><a href="<?php echo "../páginasItens/listarItens.php? var_codigo_venda=".$i['codigo']?>">Itens</a></td>
                    <td scope="row"><a href="<?php echo "../páginasPagamento/listarPagamentos.php? var_codigo_venda=".$i['codigo']."&var_id_cliente=".$i['fk_cliente_id'] ?>">Ver Pagamento</a></td>
                    <td scope="row"><a href="<?php echo "./vendaFormUpdate.php? var_id=".$i['codigo']?>">Editar</a></td>
                    <td scope="row"><a href="<?php echo "../operaçõesCRUD/delete.php? var_id=".$i['codigo']."&tabela=vendas"?>">Excluir</a></td>
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