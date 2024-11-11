<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/address-card-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro de Itens</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Cadastro de Itens</a>
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

    $codigo_venda = filter_input(INPUT_GET, "var_codigo_venda");

    $query = "SELECT * FROM produto";
    $result = mysqli_query($conexao, $query);

    $query2 = "SELECT preco, codigo FROM produto";
    $result2 = mysqli_query($conexao, $query2);

    $produtos = [];

    while ($k = mysqli_fetch_assoc($result2)) {
        $produtos[] = $k;
    }

    $jsonProdutos = json_encode($produtos);
    
    ?>

    
    <div class="d-flex justify-content-center">
        <form method="POST" action="../operaçõesCRUD/insert.php">
            <fieldset>
            <legend class="m-4">Cadastrar Item</legend>
            <input type="hidden" name="tabela" value="itens_venda">
            <div class="mb-3">
                <label class="form-label">Código Venda</label>
                <input type="text" class="form-control" name="itens_venda_codigo" placeholder="Preencha com o Código" value="<?php echo $codigo_venda?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Código do Produto</label>
                <select id="codigo_produto" class="form-select" aria-label="Default select example" name="itens_venda_codigo_produto" required>
                    <option disabled selected value="">Selecione o Produto</option>
                    <?php
                    while($j = mysqli_fetch_assoc($result)) {
                        // loop dos produtos
                    ?>
                    <option value="<?php echo $j['codigo'];?>"><?php echo $j['codigo']." - ".$j['nome'];?></option>
                    <?php
                    } // final loop dos produtos
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantidade</label>
                <input type="text" class="form-control" name="itens_venda_quantidade" placeholder="Preencha com a quantidade" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor unitário</label>
                <input type="text" id="valor_unitario" class="form-control" name="itens_venda_valor_unitario" placeholder="Preencha com o valor unitário" readonly required>
            </div>
            <button type="submit" class="btn btn-primary" >Cadastrar</button>
            </fieldset>
        </form>
    </div>

    <script>

        const produtos = <?= $jsonProdutos?>;

        //console.log(produtos);

        document.getElementById("codigo_produto").addEventListener("change", function() {
            const codigoProduto = this.value;

            const produtoSelecionado = produtos.find(produto => produto.codigo == codigoProduto);

            //console.log(codigoProduto);
            //console.log(produtoSelecionado);

            if (produtoSelecionado) {
                document.getElementById("valor_unitario").value = produtoSelecionado.preco;
            }
        });
        
    </script>

    <script src="../javascript/main.js"></script>
    <script src="https://kit.fontawesome.com/37c9ce0ae8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>