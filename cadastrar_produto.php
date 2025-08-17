<?php
#INICIANDO A SESSÃO
session_start();

#Conexão com o BD
require_once('conn.php');

#Dados do Usuario logado
$email = $_SESSION['email'];
$sql = "SELECT `id` FROM `login` WHERE `email`='$email'";
$query = mysqli_query($conn, $sql);

#Dados do formulario
$qtd = $_POST['qtd'];
$nome_produto = $_POST['nome_produto'];
$desc_produto = $_POST['desc_produto'];
$valor = $_POST['valor'];
$validade = $_POST['validade'];

if(!$query){
    ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos adciojnar o produto!")</script>
        <meta http-equiv='refresh' content='0;url=produtos.php'>
    <?php

}else{
    #obtendo o id do usuario
    $res = mysqli_fetch_array($query);
    $sql = "INSERT INTO `produtos` (`id`, `id_user`, `nome`, `descricao`, `valor`, `qtd`, `validade`) 
    VALUES (NULL, '$res[0]', '$nome_produto', '$desc_produto', '$valor', '$qtd', '$validade')";
    $query = mysqli_query($conn, $sql);

    if(!$query){
        ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos adciojnar o produto!")</script>
        <meta http-equiv='refresh' content='0;url=produtos.php'>
        <?php
    }else{
        ?>
        <meta http-equiv='refresh' content='0;url=produtos.php'>
        <?php
    }
}
