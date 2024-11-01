<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../conexao.php');

function atualizarCliente($id, $nome, $telefone) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE cliente SET nome = '{$nome}', telefone = '{$telefone}' WHERE id = {$id}";
    mysqli_query($conexao, $query);
}

if($_POST['tabela'] === 'cliente') {
    atualizarCliente($_POST['cliente_id'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header("Location: ../páginasClientes/listarClientes.php");
}

?>

