<?php
if( isset($_GET["id"])){
    $id = $_GET["id"];

    //informacoes servidor
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_database = "myshop";

    //criando a conexao com o banco
    $conn = new mysqli($db_server,$db_username,$db_password,$db_database);

    $sql = "DELETE FROM clients WHERE id=$id";
    $conn->query($sql);
}

header("location: /");
exit;
?>