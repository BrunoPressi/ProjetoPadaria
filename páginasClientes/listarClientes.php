<!DOCTYPE html>
<html lang="PT-BR" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imgs/person-solid.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Clientes</title>
</head>
<body>
    
    <div class="d-flex justify-content-center">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>   
            <tbody>
                <?php

                include_once('../conexao.php');
                        
                $conexao = conexaoMYSQL();

                $query = "SELECT * FROM cliente";
                $resultado = mysqli_query($conexao, $query);

                while($i = mysqli_fetch_assoc($resultado)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $i['id']; ?></th>
                    <td> <?php echo $i['nome']; ?></td>
                    <td> <?php echo $i['cpf']; ?></td>
                    <td> <?php echo $i['telefone']; ?></td>
                </tr>
            </tbody>
                <?php
                } // final while
                ?>
        </table>
    </div>

    <h5><a href="../index.html">Página Inicial</h5>
    <h5><a href="./clienteFormInsert.html">Cadastrar Novo Cliente</h3>

    <script src="https://kit.fontawesome.com/37c9ce0ae8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>