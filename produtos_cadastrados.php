<?php
#INICIANDO A SESSÃO
session_start();

#Conexão com o BD
require_once('conn.php');

#Dados do Usuario logado
$email = $_SESSION['email'];
$sql = "SELECT `id` FROM `login` WHERE `email`='$email'";
$query = mysqli_query($conn, $sql);


#obtendo o id do usuario
$res = mysqli_fetch_array($query);
$sql = "SELECT * FROM `produtos` WHERE `id_user` = $res[0]";
$query = mysqli_query($conn, $sql);

$produtos_cadastrados ='';

while($consulta = mysqli_fetch_array($query)){
    #var_dump($consulta);
    $produtos_cadastrados .= "
        <tr>
            <form method='post' action='acao_produto_cadastrado.php'>
            <td>
                <input type='number' name='cod' id='cod' value='$consulta[0]' />
            </td>
            <td>
                <input type='number' name='qtd' id='qtd' value='$consulta[5]' />
            </td>
            <td>
                <input type='text' name='nome_produto' id='nome_produto' value='$consulta[2]'/>
            </td>
            <td>
                <input type='text' name='desc_produto' id='desc_produto' value='$consulta[3]'/>
            </td>
            <td>
                <input type='number' name='valor' id='valor' value='$consulta[4]'/>
            </td>
            <td>
                <input type='date' name='validade' id='validade' value='$consulta[6]'/>
            </td>
            <td>
                <input type='submit' name='acao_atualizar' id='acao_atualizar' value='atualizar' />
                <input type='submit' name='acao_excluir' id='acao_excluir' value='excluir' />
            </td>
            </form>
        </tr>
    ";
    
}


