<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include_once('../conexao.php');

#--------------------------------

function insertCliente($id, $cpf, $nome, $telefone) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO cliente(id, cpf, nome, telefone) VALUES({$id}, '{$cpf}', '{$nome}', '{$telefone}')";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function insertFuncionario($id, $cpf, $nome, $telefone, $salario, $cargo) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO funcionario(id, cpf, nome, telefone, salario, cargo) VALUES({$id}, '{$cpf}', '{$nome}', '{$telefone}', {$salario}, '{$cargo}')";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function insertProduto($codigo, $nome, $preco, $categoria, $quantidade_em_estoque) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO produto(codigo, nome, preco, categoria, quantidade_em_estoque) VALUES({$codigo}, '{$nome}', {$preco}, '{$categoria}', {$quantidade_em_estoque})";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function insertVenda($codigo, $valor_total, $quantidade_total, $fk_cliente_id, $fk_funcionario_id) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO venda(codigo, valor_total, quantidade_total, fk_cliente_id, fk_funcionario_id) VALUES({$codigo}, {$valor_total}, {$quantidade_total}, {$fk_cliente_id}, {$fk_funcionario_id})";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

if($_POST['tabela'] == 'cliente') {
    insertCliente($_POST['cliente_id'], $_POST['cliente_cpf'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header('Location: ../páginasClientes/listarClientes.php');
}
else if($_POST['tabela'] == 'funcionário') {
    insertFuncionario($_POST['funcionario_id'], $_POST['funcionario_cpf'], $_POST['funcionario_nome'], $_POST['funcionario_telefone'], $_POST['funcionario_salario'], $_POST['funcionario_cargo']);
    header('Location: ../páginasFuncionários/listarFuncionarios.php');
}
else if($_POST['tabela'] == 'produto') {
    insertProduto($_POST['produto_codigo'], $_POST['produto_nome'], $_POST['produto_preco'], $_POST['produto_categoria'], $_POST['produto_quantidade']);
    header("Location: ../páginasProdutos/listarProdutos.php");
}
else if($_POST['tabela'] == 'venda') {
    insertVenda($_POST['venda_codigo'], $_POST['venda_valor_total'], $_POST['venda_quantidade_total'], $_POST['venda_cliente_id'], $_POST['venda_funcionario_id']);
    header("Location: ../PáginasVendas/listarVendas.php");
}

?>