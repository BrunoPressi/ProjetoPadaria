<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include_once("../conexao.php");

$tabela = (string) filter_input(INPUT_GET, 'tabela');
$id = filter_input(INPUT_GET, 'var_id');
$codigo_produto = filter_input(INPUT_GET,"codigo_produto");

#--------------------------------

function deleteCliente($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM cliente WHERE id = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function deleteFuncionario($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM funcionario WHERE id = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function deleteProduto($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM produto WHERE codigo = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function deleteVenda($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM venda WHERE codigo = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function deletePagamento($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM pagamento WHERE id = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function deleteItensVenda($id, $codigo_produto) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM itens_venda WHERE codigo_venda = {$id} AND codigo_produto = $codigo_produto";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------


if($tabela === "clientes") {
    try {
        deleteCliente($id);
        header("Location: ../páginasClientes/listarClientes.php");
    } catch (mysqli_sql_exception $erro) {
        if ($erro -> getCode() == '1451') {
            echo "Não é possível excluir esse cliente, pois, o mesmo está relacionado a determinadas vendas!!";
        } else {
            echo "Erro inesperado: ". $erro->getMessage();
        }
    }
}
else if($tabela === "funcionarios") {
    try {
        deleteFuncionario($id);
        header("Location: ../páginasFuncionários/listarFuncionarios.php");
    } catch (mysqli_sql_exception $erro) {
        if ($erro -> getCode() == '1451') {
            echo "Não é possível excluir esse funcionários, pois, o mesmo está relacionado a determinadas vendas!!";
        } else {
            echo "Erro inesperado: ". $erro->getMessage();
        }
    }
    
}
else if($tabela === "produtos") {
    try {
        deleteProduto($id);
        header("Location: ../páginasProdutos/listarProdutos.php");
    } catch (mysqli_sql_exception $erro) {
        if ($erro -> getCode() == '1451') {
            echo "Não é possível excluir esse produto, pois, o mesmo está relacionado a determinadas vendas!!";
        } else {
            echo "Erro inesperado: ". $erro->getMessage();
        }
    }
}
else if($tabela === "vendas") {
    try {
        deleteVenda($id);
        header("Location: ../PáginasVendas/listarVendas.php");
    } catch (mysqli_sql_exception $erro) {
        if ($erro -> getCode() == '1451') {
            echo "Não é possível excluir essa venda, pois, a mesma está relacionado a determinados itens e pagamentos!";
        } else {
            echo "Erro inesperado: ". $erro->getMessage();
        }
    }
}
else if($tabela === "pagamentos") {
    deletePagamento($id);
    header("Location: ../PáginasVendas/listarVendas.php");
}
else if($tabela === "itens_venda") {
    deleteItensVenda($id, $codigo_produto);
    header("Location: ../PáginasVendas/listarVendas.php");
}

?>