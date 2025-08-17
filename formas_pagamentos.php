<?php
#INICIANDO A SESSÃO
session_start();

#Conexão com o BD
require_once('conn.php');


$dinheiro = isset($_POST['dinheiro']) == 'on' ? 'aceita' : 'não aceita';
$pix = isset($_POST['pix']) == 'on' ? 'aceita' : 'não aceita';
$cartao = isset($_POST['cartao']) == 'on' ? 'aceita' : 'não aceita';
$caderneta = isset($_POST['caderneta']) == 'on' ? 'aceita' : 'não aceita';

#var_dump("Dinheiro: $dinheiro, Pix: $pix, Cartão: $cartao, Caderneta: $caderneta");

#Obtendo o ID do usuario logado
$email = $_SESSION['email'];
$sql = "SELECT `id` FROM `login` WHERE `email`='$email'";
$query = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($query);

$sql = "SELECT `id_usuario` FROM `formas_pagamentos` WHERE `id_usuario`='$res[0]'";
$query2 = mysqli_query($conn, $sql);
$qtd_user = mysqli_num_rows($query2);
#print_r($qtd_user);

if($qtd_user !== 1){
    
    $id = $res[0];

    $sql = "INSERT INTO `formas_pagamentos` (`id`, `id_usuario`, `dinheiro`, `pix`, `cartao`, `caderneta`) 
        VALUES (NULL, '$res[0]', '$dinheiro', '$pix', '$cartao', '$caderneta')";
        $query = mysqli_query($conn, $sql);

    if(!$query){
        ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos atualizar as suas formas de pagamentos!")</script>
        <meta http-equiv='refresh' content='0;url=config.php'>
        <?php

    }else{
        echo "<meta http-equiv='refresh' content='0;url=config.php'>";
    }
}else{
    
    $id = $res[0];

    $sql = "UPDATE `formas_pagamentos` SET `dinheiro` = '$dinheiro', `pix` = '$pix', `cartao` = '$cartao', `caderneta` = '$caderneta'
    WHERE `formas_pagamentos`.`id_usuario` = '$id'";
    $query = mysqli_query($conn, $sql);

    if(!$query){
        ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos atualizar as suas formas de pagamentos!")</script>
        <meta http-equiv='refresh' content='0;url=config.php'>
        <?php

    }else{
        echo "<meta http-equiv='refresh' content='0;url=config.php'>";
    }
}
