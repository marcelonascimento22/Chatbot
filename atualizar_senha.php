<?php
#INICIANDO A SESSÃO
session_start();

#Conexão com o BD
require_once('conn.php');


$nova_senha = $_POST['senha'];
$conf_nova_senha = $_POST['confirmar_senha'];
$email = $_SESSION['email'];

if($nova_senha == $conf_nova_senha){
    $sql = "UPDATE `login` SET `senha` = '$nova_senha' WHERE `login`.`email` = '$email'";
    $query = mysqli_query($conn, $sql);

    if(!$query){
        ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos atualizar a sua senha, tente novamente!")</script>
        <meta http-equiv='refresh' content='0;url=config.php'>
        <?php

    }else{
        ?>
        <script>alert("Senha atualizada com sucesso")</script>
        <meta http-equiv='refresh' content='0;url=config.php'>
        <?php
    }
}
