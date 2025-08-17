<?php
require_once('validar_sessao.php');
require_once('produtos_cadastrados.php');


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
        /*width: 30px;
        padding: 15px;*/
        text-align: center;
      }
      
      th {
        background-color: #eee;
      }
      
      input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        /** width: 100%; */
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
          <li class="menu-item active"><a href="produtos.php" data-scroll>PRODUTOS</a></li>
          <li class="menu-item"><a href="pedidos.php" data-scroll>PEDIDOS</a></li>
          <li class="menu-item"><a href="config.php" data-scroll>CONFIGURAÇÕES</a></li>      
          <?php if($adm !== 0){ echo '<li class="menu-item"><a href="admin.php" data-scroll>ADMIN</a></li>';} ?>     
          <li class="menu-item"><a href="sair.php" data-scroll>SAIR</a></li>
    
        </ul>
      </nav>
    </header>

    <section id="home">
    <body>
        <div align='center'>

        <h3>Pesquisar Produto </h3>
      <br>
      <table>
        <tr>
          
          <th>Cód</th>
          <th>Quantidade</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Valores</th>
          <th>Validade</th>
          <th>Ação</th>
        </tr>
        <tr>
          <form method="post" action="cadastrar_produto.php">
            
            <td>
              
            </td>
            <td>
              <input type="number" name="qtd" id="qtd" min="1"/>
            </td>
            <td>
              <input type="text" name="nome_produto" id="nome_produto"/>
            </td>
            <td>
              <input type="text" name="desc_produto" id="desc_produto"/>
            </td>
            <td>
              <input type="number" name="valor" id="valor" min="1" />
            </td>
            <td>
              <input type="date" name="validade" id="validade" min="1" />
            </td>
            <td>
              <input type="submit" name="salvar" id="salvar" value="Salvar" />
            </td>
          </form>
        </tr>
      </table>
      <br><br>
          <h3>Cadastrar Produto </h3>
      <br>
      <table>
        <tr>
          
          <th>Cód</th>
          <th>Quantidade</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Valores</th>
          <th>Validade</th>
          <th>Ação</th>
        </tr>
        <tr>
          <form method="post" action="cadastrar_produto.php">
            
            <td>
              
            </td>
            <td>
              <input type="number" name="qtd" id="qtd" min="1"/>
            </td>
            <td>
              <input type="text" name="nome_produto" id="nome_produto"/>
            </td>
            <td>
              <input type="text" name="desc_produto" id="desc_produto"/>
            </td>
            <td>
              <input type="number" name="valor" id="valor" min="1" />
            </td>
            <td>
              <input type="date" name="validade" id="validade" min="1" />
            </td>
            <td>
              <input type="submit" name="salvar" id="salvar" value="Salvar" />
            </td>
          </form>
        </tr>
      </table>
      <br><br>
      <h3> Produtos Cadastrados </h3>
      <br>
      <table>
        
        
        <tr>
          
          <th>Cód</th>
          <th>Quantidade</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Valores</th>
          <th>Validade</th>
          <th>Ação</th>
        </tr>
        <?php echo $produtos_cadastrados; ?>
  
      </table>
  </body>
    </div>
    </section>

  

    <script src="js/fastclick.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/fixed-responsive-nav.js"></script>
  </body>
</html>
