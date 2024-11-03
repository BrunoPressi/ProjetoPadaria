<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../conexao.php');

function atualizarCliente($id, $nome, $telefone) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE cliente SET nome = '{$nome}', telefone = '{$telefone}' WHERE id = {$id}";
    mysqli_query($conexao, $query);
}

function atualizarFuncionario($id, $nome, $telefone, $salario, $cargo) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE funcionario SET nome = '{$nome}', telefone = '{$telefone}', salario = {$salario}, cargo = '{$cargo}' WHERE id = {$id}";
    mysqli_query($conexao, $query);
}

if($_POST['tabela'] === 'cliente') {
    atualizarCliente($_POST['cliente_id'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header("Location: ../páginasClientes/listarClientes.php");
} 
else if($_POST['tabela'] === 'funcionario') {
    atualizarFuncionario($_POST['funcionario_id'], $_POST['funcionario_nome'], $_POST['funcionario_telefone'], $_POST['funcionario_salario'], $_POST['funcionario_cargo']);
    header("Location: ../páginasFuncionários/listarFuncionarios.php");
}

?>