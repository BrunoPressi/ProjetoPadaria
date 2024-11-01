<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include_once('../conexao.php');

function insertCliente($id, $cpf, $nome, $telefone) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO cliente(id, cpf, nome, telefone) VALUES({$id}, '{$cpf}', '{$nome}', '{$telefone}')";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

function insertFuncionario($id, $cpf, $nome, $telefone, $salario, $cargo) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO funcionario(id, cpf, nome, telefone, salario, cargo) VALUES({$id}, '{$cpf}', '{$nome}', '{$telefone}', {$salario}, '{$cargo}')";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}


if($_POST['tabela'] == 'cliente') {
    insertCliente($_POST['cliente_id'], $_POST['cliente_cpf'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header('Location: ./páginasClientes/listarClientes.php');
}if($_POST['tabela'] == 'funcionário') {
    insertFuncionario($_POST['funcionario_id'], $_POST['funcionario_cpf'], $_POST['funcionario_nome'], $_POST['funcionario_telefone'], $_POST['funcionario_salario'], $_POST['funcionario_cargo']);
    header('Location: ../páginasFuncionários/listarFuncionarios.php');
}

?>