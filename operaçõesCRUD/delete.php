<?php

ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../conexao.php");

function deleteCliente($cliente_id) {
    $conexao = conexaoMYSQL();

    $query = "DELETE FROM cliente WHERE id = {$cliente_id}";

    mysqli_query($conexao, $query);
    mysqli_close($conexao);
}

$cliente_id = filter_input(INPUT_GET, "var_id");
deleteCliente($cliente_id);
header("Location: ../páginasClientes/listarClientes.php");


?>