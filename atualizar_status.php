<?php
#Conexão com o BD
require_once('conn.php');
$id = $_POST['user'];
$status = $_POST['status'] == 'ativo' ? 1 : 0;


$sql = "UPDATE `login` SET `status` = '$status' WHERE `login`.`id` = $id";
$query = mysqli_query($conn, $sql);

if(!$query){
    ?>
        <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos atualizar o estatus dos usuario!")</script>
        <meta http-equiv='refresh' content='0;url=admin.php'>
    <?php

}else{
    echo "<meta http-equiv='refresh' content='0;url=admin.php'>";
}

