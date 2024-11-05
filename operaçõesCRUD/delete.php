<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include_once("../conexao.php");

$tabela = (string) filter_input(INPUT_GET, 'tabela');
$id = filter_input(INPUT_GET, 'var_id');

function deleteCliente($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM cliente WHERE id = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

function deleteFuncionario($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM funcionario WHERE id = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

function deleteProduto($id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM produto WHERE codigo = {$id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

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

?>