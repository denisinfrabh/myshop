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

//criando variaveis dos campos do formulario
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$erroMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET: Metodo para buscar/mostrar a informação do cadastro

    if(!isset($_GET["id"])){
        header("location: /teste.php");
        exit;
    }

    $id = $_GET["id"];

    //Ler a linha especifica do cadastro do cliente
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
}
else{
    //POST: Metodo para atualizar a informação do cadastro

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if( empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)){
            $erroMessage = "Todos os campos são obrigatorios";
            break;
        }

        $sql = "UPDATE clients " . 
               "SET name = '$name', email = '$email', phone = '$phone', address = '$address' " . 
               "WHERE id = $id";
        
        $result = $conn->query($sql);

        if(!$result){
            $erroMessage = "Pesquisa invalida: " . $conn->error;
            break;
        }

        $successMessage = "Cadastro Atualizado com Sucesso!";

        header("location: /");
        exit;

    }while(false);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR - MyShop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Editar informação Cliente</h2>
		<a class="btn btn-primary" href="/" role="button">Voltar</a>
		<br>
        <br>

        <?php
        if(!empty($erroMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$erroMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
         ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>

            <?php
            if( !empty($successMessage)){
                echo "
                <div class='row-mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissbile fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>

                        </div>
                    </div>
                </div>
                ";
            }

            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">SALVAR</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/" role="button">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

</body>
</html>