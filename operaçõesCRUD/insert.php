<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('conexao.php');

function insertCliente($id, $cpf, $nome, $telefone) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO cliente(id, cpf, nome, telefone) VALUES({$id}, '{$cpf}', '{$nome}', '{$telefone}')";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}


if($_POST['tabela'] == 'cliente') {
    insertCliente($_POST['cliente_id'], $_POST['cliente_cpf'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header('Location: ./páginasClientes/listarClientes.php');
}

?>