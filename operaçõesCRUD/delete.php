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
    deleteCliente($id);
    header("Location: ../páginasClientes/listarClientes.php");
}
else if($tabela === "funcionarios") {
    deleteFuncionario($id);
    header("Location: ../páginasFuncionários/listarFuncionarios.php");
}
else if($tabela === "produtos") {
    deleteProduto($id);
    header("Location: ../páginasProdutos/listarProdutos.php");
}
else if($tabela === "vendas") {
    deleteVenda($id);
    header("Location: ../PáginasVendas/listarVendas.php");
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