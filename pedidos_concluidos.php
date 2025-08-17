<?php 
#Iniciando a sessão
session_start();

#Coneção com o bd
require_once("conn.php");

#Dados do Usuario logado
$email = $_SESSION['email'];
$sql = "SELECT `id` FROM `login` WHERE `email`='$email'";
$query = mysqli_query($conn, $sql);
#Id do usuario logado
$id_user = mysqli_fetch_array($query);

#status do Pedido
# Status: 0 - Pendente
# Status: 1 - Aprovado
# Status: 2 - Recusado

#SQL para selecionar nas tabelas cliente, produdos e pedidos.
$sql = "SELECT clientes.id as id_cliente, clientes.nome as nome_cliente, clientes.telefone, clientes.endereco,
pedidos.id as id_pedido, pedidos.forma_pagamento, pedidos.status, id_usuario
FROM login, clientes, pedidos, produtos 
WHERE login.id = $id_user[0] 
AND clientes.id_usuario = $id_user[0] 
AND clientes.id = pedidos.id_cliente 
AND pedidos.id_produtos = produtos.id 
AND pedidos.status = 1";
$query = mysqli_query($conn, $sql);
$id_cliente = array();
$teste = 0;

 while ($res = mysqli_fetch_array($query)){
  $total = 0;

  #Testa para verificar os pedidos do mesmo cliente
    $teste = array_search($res['id_cliente'], $id_cliente);
  #adiciona o id do cliente no array de teste
    $id_cliente[] = $res["id_cliente"];
#valida o teste para não duplicar o pedido no painel
    if($teste === false){
  ?>
















    <form id="form1" name="form1" method="post" action="">
  <table width="80%" border="0">
    <tr>
      <td colspan="2"><div align="center"><H1>PEDIDO Nº <?php echo $res['id_pedido'];?></H1></div></td>
    </tr>
    <tr>
      <td><div align="center"><b>PRODUTO</b></div></td>
      <td><div align="center"><b>QUANTIDADE</b></div></td>
      <td><div align="center"><b>VALOR</b></div></td>
    </tr>
    <?php
    #Seleciona os produtos pedidos para fazer uma unica solicitação
    $sql2 = "SELECT pedidos.id as id_pedido, pedidos.quantidade, pedidos.valor,
pedidos.status, produtos.id as id_produto, produtos.nome as nome_produto 
FROM login, clientes, pedidos, produtos 
WHERE login.id = $id_user[0] 
AND clientes.id=$res[0] 
AND clientes.id = pedidos.id_cliente 
AND pedidos.id_produtos = produtos.id
AND pedidos.status = 1";
$query2 = mysqli_query($conn, $sql2);

 while ($pedidos = mysqli_fetch_array($query2)){
  #Cria uma string com todos os id's dos produtos do pedido para futura atualização do status
  $id_pedidos .= $pedidos['id_pedido']. ",";
#var_dump($id_pedidos);
?>
<input type='hidden' id='user' name='user' value='<?php echo $id_pedidos; ?>'>
<tr>
      <td><br><div align="center"><?php echo $pedidos['nome_produto'];?></div></td>
      <td><div align="center"><?php echo $pedidos['quantidade'];?></div></td>
      <td><div align="center">R$ <?php $total = $total + ($pedidos['quantidade'] * $pedidos['valor']) ; echo $pedidos['quantidade'] * $pedidos['valor'] ;?></div></td>
    </tr>
    

<?php

 }
 #Limpa a lista de id's
 $id_pedidos = '';
    ?>
    <tr>
      <td colspan="2"><br><div align="center">TOTAL</div></td>
      <td><div align="center">R$ <?php echo $total ; ?></div></td>
    </tr>
 
  <tr>
      <td colspan="3"><div align="center"><b>CLIENTE:</b></div></td>
    </tr>
    <tr>
      <td colspan="3"><div align="center"><?php echo $res['id_cliente']." - ".$res['nome_cliente'];?></div></td>
    </tr>

    <!--
    <tr>
      <td>
        <label>
          <div align="center">
            <input type="submit" name="button" id="button" value="ACEITAR" formaction="aceitar.php" />
          </div>
        </label>
      </td>
      <td>
        <label>
          <div align="center">
            
          </div>
        </label>
      </td>
      <td>
        <label>
          <div align="center">
            <input style="background-color: red;" type="submit" name="button" id="button" value="RECUSAR" formaction="recusar.php" />
          </div>
        </label>
      </td>

      

    </tr>
-->
  </table>
</form>
<?php

}
 }

?>
