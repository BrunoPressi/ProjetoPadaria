<?php

function conexaoMYSQL() {
    $servername = "localhost";
    $database = "projeto_padaria";
    $username = "root";
    $userpassword = "";

    $conexao = mysqli_connect($servername, $username, $userpassword, $database);

    // Verificar conexão
    if (!$conexao) {
        die("conexao falhou". mysqli_connect_error());
    } else {
        // echo "sucesso";
    }

    return $conexao;
    }

?>