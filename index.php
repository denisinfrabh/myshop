<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>
<body>
    <div class="container my-5">
        <h2>Lista de Clientes</h2>
        <a class="btn btn-primary" href="/create.php" role="button">Novo Cliente</a>
        <br>
        <!-- cria tabela-->
        <table class="table">
            <!--titulo das colunas-->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Criado em</th>
                    <th>Açao</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                //informacoes servidor
                $db_server = "localhost";
                $db_username = "root";
                $db_password = "";
                $db_database = "myshop";
                
                //criando a conexao com o banco
                $conn = new mysqli($db_server,$db_username,$db_password,$db_database);
                
                //checar a conexao com o banco
                if($conn->connect_error){
                    die("Erro de Conexão: " . $conn->connect_error);
                }
                
                //lear as informaçoes do banco
                $sql = "SELECT * FROM clients";
                $result = $conn->query($sql);
                
				if(!$result){
                    die("Pesquisa Invalida: " . $conn->error);
                }
                // escreve a linha de cada informação do banco
                while($row = $result->fetch_assoc()){
                    echo"<tr>";
                    echo"<td>$row[id]</td>";
                    echo"<td>$row[name]</td>";
                    echo"<td>$row[email]</td>";
                    echo"<td>$row[phone]</td>";
                    echo"<td>$row[address]</td>";
                    echo"<td>$row[create_at]</td>";
                    echo"<td>";
                    echo"<a class='btn btn-primary btn-sm' href='/editar.php?id=$row[id]'>Editar</a> ";
                    echo"<a class='btn btn-danger btn-sm' href='/apagar.php?id=$row[id]'>Apagar</a>";
                    echo"</td>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
