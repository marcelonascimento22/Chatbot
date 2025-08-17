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
$cod = $_POST['cod'];
$qtd = $_POST['qtd'];
$nome_produto = $_POST['nome_produto'];
$desc_produto = $_POST['desc_produto'];
$valor = $_POST['valor'];
$validade = $_POST['validade'];
$acao_up = isset($_POST['acao_atualizar']);
$acao_del = isset($_POST['acao_excluir']);

if($acao_up){
    $sql = "UPDATE `produtos` SET `nome` = '$nome_produto', `descricao` = '$desc_produto', `valor` = '$valor', `qtd` = '$qtd', `validade` = '$validade'
    WHERE `produtos`.`id` = $cod";
    $query = mysqli_query($conn, $sql);
    $acao_up == '';
    if(!$query){
        ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos realizar a ação!")</script>
        <meta http-equiv='refresh' content='0;url=produtos.php'>
        <?php
    }else{
        ?>
        <meta http-equiv='refresh' content='0;url=produtos.php'>
        <?php
    }
}

if($acao_del){
    $sql = "DELETE FROM produtos WHERE `produtos`.`id` = $cod";
    $query = mysqli_query($conn, $sql);
    $acao_del == '';
    if(!$query){
        ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos realizar a ação!")</script>
        <meta http-equiv='refresh' content='0;url=produtos.php'> 
        <?php
    }else{
        ?>
        <meta http-equiv='refresh' content='0;url=produtos.php'>
        <?php
    }
}
