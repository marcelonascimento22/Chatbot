<?php
#Conexão com o BD
require_once('conn.php');

$id_produto = explode(",", $_POST['user']);

#status do Pedido
# Status: 0 - Pendente
# Status: 1 - Aprovado
# Status: 2 - Recusado


#Pega os id's dos pedidos para atualizar o status
foreach($id_produto as $percorre){
    if($percorre !== ''){
        $sql = "UPDATE `pedidos` SET `status` = '1' WHERE `pedidos`.`id` = '$percorre'";
        $query = mysqli_query($conn, $sql);
        if(!$query){
            ?>
            <script>alert("ERROR! Aconteceu alguma coisa, não conseguimos atualizar o status do produto!")</script>
            <meta http-equiv='refresh' content='0;url=pedidos.php'>
            <?php
        }
    }
    
}
echo "<meta http-equiv='refresh' content='0;url=pedidos.php'>";