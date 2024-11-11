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

function atualizarPagamento($id, $valor_pago, $data_pagamento, $forma_pagamento, $fk_cliente_id, $fk_venda_codigo) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE pagamento SET valor_pago = {$valor_pago}, data_pagamento = '{$data_pagamento}', forma_pagamento = '{$forma_pagamento}', fk_cliente_id = {$fk_cliente_id}, fk_venda_codigo = {$fk_venda_codigo} WHERE id = {$id}";
    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

#--------------------------------

function atualizarItemVenda($codigoProduto, $codigo_venda, $quantidade, $valor_unitario) {
    $conexao = conexaoMYSQL();

    $query = "UPDATE itens_venda SET quantidade = {$quantidade}, valor_unitario = {$valor_unitario} WHERE codigo_venda = {$codigo_venda} AND codigo_produto = {$codigoProduto}";
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
else if($_POST['tabela'] === 'pagamentos') {
    atualizarPagamento($_POST['pagamento_id'], $_POST['pagamento_valor_pago'], $_POST['pagamento_data'], $_POST['pagamento_forma'], $_POST['pagamento_cliente'], $_POST['pagamento_codigo_venda']);
    header("Location: ../PáginasVendas/listarVendas.php");
}
else if($_POST['tabela'] === 'itens_venda') {
    atualizarItemVenda($_POST['itens_venda_codigo_produto'], $_POST['itens_venda_codigo'], $_POST['itens_venda_quantidade'], $_POST['itens_venda_valor_unitario']);
    header("Location: ../PáginasVendas/listarVendas.php");
}
?>