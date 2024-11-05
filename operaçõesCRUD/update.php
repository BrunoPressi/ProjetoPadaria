<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('../conexao.php');

#--------------------------------

function atualizarCliente($id, $nome, $telefone) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE cliente SET nome = '{$nome}', telefone = '{$telefone}' WHERE id = {$id}";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function atualizarFuncionario($id, $nome, $telefone, $salario, $cargo) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE funcionario SET nome = '{$nome}', telefone = '{$telefone}', salario = {$salario}, cargo = '{$cargo}' WHERE id = {$id}";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function atualizarProduto($codigo, $nome, $preco, $categoria, $quantidade_em_estoque) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE produto SET nome = '{$nome}', preco = {$preco}, categoria = '{$categoria}', quantidade_em_estoque = {$quantidade_em_estoque} WHERE codigo = {$codigo}";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

function atualizarVenda($codigo, $valor_total, $quantidade_total, $fk_cliente_id, $fk_funcionario_id) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE venda SET valor_total = '{$valor_total}', quantidade_total = {$quantidade_total}, fk_cliente_id = {$fk_cliente_id}, fk_funcionario_id = {$fk_funcionario_id} WHERE codigo = {$codigo}";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

if($_POST['tabela'] === 'cliente') {
    atualizarCliente($_POST['cliente_id'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header("Location: ../páginasClientes/listarClientes.php");
} 
else if($_POST['tabela'] === 'funcionario') {
    atualizarFuncionario($_POST['funcionario_id'], $_POST['funcionario_nome'], $_POST['funcionario_telefone'], $_POST['funcionario_salario'], $_POST['funcionario_cargo']);
    header("Location: ../páginasFuncionários/listarFuncionarios.php");
}
else if($_POST['tabela'] === 'produtos') {
    atualizarProduto($_POST['produto_codigo'], $_POST['produto_nome'], $_POST['produto_preco'], $_POST['produto_categoria'], $_POST['produto_estoque']);
    header("Location: ../páginasProdutos/listarProdutos.php");
}
else if($_POST['tabela'] === 'vendas') {
    atualizarVenda($_POST['venda_codigo'], $_POST['venda_valor_total'], $_POST['venda_quantidade_total'], $_POST['venda_cliente_id'], $_POST['venda_funcionario_id']);
    header("Location: ../PáginasVendas/listarVendas.php");
}

?>