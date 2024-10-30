<?php

include_once('conexao.php');

function insertCliente($id, $cpf, $nome, $telefone) {
    $conexao = conexaoMYSQL();
    $query = "INSERT INTO cliente(id, cpf, nome, telefone) VALUES({$id}, '{$cpf}', '{$nome}', '{$telefone}')";

    // Tratamento de erros
    if (mysqli_query($conexao, $query)) {
        //echo "Cliente cadastrado com sucesso";
    } else {
        echo "Erro ao cadastrar cliente: ". mysqli_error($conexao);
    }

    mysqli_close($conexao);
}


if($_POST['tabela'] == 'cliente') {
    insertCliente($_POST['cliente_id'], $_POST['cliente_cpf'], $_POST['cliente_nome'], $_POST['cliente_telefone']);
    header('Location: ./páginasClientes/listarClientes.php');
}

?>