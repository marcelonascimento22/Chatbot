<?php
require_once('validar_sessao.php');

?>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
  }
  
  form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    margin: 0 auto;
  }
  
  table {
    width: 100%;
  }
  
  th,
  td {
    padding: 10px;
    text-align: left;
  }
  
  th {
    background-color: #eee;
  }
  
  tr:nth-child(odd) {
    background-color: #f2f2f2;
  }
  
  tr:nth-child(even) {
    background-color: #d9d9d9;
  }
  
  input[type="text"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    margin-top: 5px;
  }
  
  input[type="submit"] {
    padding: 10px;
    background-color: #4CAF50;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
  }
  
  input[type="submit"]:hover {
    background-color: #3e8e41;
  }
  
  .recusar-btn {
    background-color: #ff0000;
    color: #fff;
  }
</style>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>DELIVERY</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="css/ie.css">
    <![endif]-->
    <script src="js/responsive-nav.js"></script>
  </head>
  <body>

    <header>
      <a href="index.php" class="logo" data-scroll>DELIVERY</a>
      <nav class="nav-collapse">
        <ul>
          <li class="menu-item "><a href="index.php" data-scroll>VENDAS</a></li>
          <li class="menu-item "><a href="produtos.php" data-scroll>PRODUTOS</a></li>
          <li class="menu-item active"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
          <li class="menu-item"><a href="config.php" data-scroll>CONFIGURAÇÕES</a></li>      
          <?php if($adm !== 0){ echo '<li class="menu-item"><a href="admin.php" data-scroll>ADMIN</a></li>';} ?>    
          <li class="menu-item"><a href="sair.php" data-scroll>SAIR</a></li>
    
        </ul>
      </nav>
    </header>

    <section id="home">
    <body>
        <div align='center'>
<?php include "pedidos_pendentes.php"; ?>
        <!--
        <form id="form1" name="form1" method="post" action="">
  <table width="80%" border="0">
    <tr>
      <td colspan="2"><div align="center"><H1>NOVO PEDIDO</H1></div></td>
    </tr>
    <tr>
      <td><div align="center"><b>PRODUTO</b></div></td>
      <td><div align="center"><b>QUANTIDADE</b></div></td>
    </tr>
    <tr>
      <td><br><div align="center">GÁS</div></td>
      <td><div align="center">1</div></td>
    </tr>
    <tr>
      <td><br><div align="center">ÁGUA</div></td>
      <td><div align="center">1</div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><b>CLIENTE:</b></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">31 984767330 - Victor</div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><b>ENDEREÇO<b></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">RUA ENDEREÇO EXEMPO....</div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"><b>FORMA DE PAGAMENTO<b></div></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">PAGAMENTO MODELO</div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
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
          <button style="background-color: red;">
        <a href="recusar.php" style="text-decoration: none; color: white;"><h2>Recusar</h2></a>
            </button>
          </div>
        </label>
      </td>
    </tr>
  </table>
</form>
-->

    </div>
    </section>

  

    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>
