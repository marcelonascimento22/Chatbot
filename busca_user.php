<?php
#Conexão com o BD
require_once('conn.php');

#var_dump($_REQUEST);

$opcao_busca = $_POST['opcao_busca'];
$nome_usuario = isset($_POST['nome_usuario'])? $_POST['nome_usuario'] : "";
#'opcao_busca' => string 'nome' (length=4)
#'nome_usuario' => string 'marcedlo' (length=8)
#'opcao_busca' => string 'todos' (length=5)
$resultado = "";


if($opcao_busca == 'nome'){
    $sql = "SELECT * FROM `login` WHERE `nome` LIKE '%$nome_usuario%'";
    $query = mysqli_query($conn, $sql);
    

    while($consulta = mysqli_fetch_array($query)){
        $consulta['status'] = $consulta['status'] == 1 ? 'ATIVO' : 'INATIVO';
        $ativo = $consulta['status'] == 'ATIVO' ? 'checked' : '';
        $inativo = $consulta['status'] == 'INATIVO' ? 'checked' : '';
        #var_dump($consulta);
        $resultado .= "
            <form method='post' action='atualizar_status.php'>
                <h2>Usuário</h2>
                    <input type='hidden' id='user' name='user' value='".$consulta['id']."'>
                    <p>Nome: ".$consulta['nome']." </p>
                    <p>Email: ".$consulta['email']." </p>
                    <p>Status: ". $consulta['status']." </p>
                <label>
                    <input type='radio' name='status' value='ativo' "
                    .$ativo." > Ativar
                </label>
                <label>
                    <input type='radio' name='status' value=inativo' "
                    . $inativo." > Desativar
                </label>
                <input type='submit' value='Salvar'>
            </form>
        
        ";
    }
    #echo "<meta http-equiv='refresh' content='0;url=admin.php'>";
}
if($opcao_busca == 'todos'){
    $sql = "SELECT * FROM `login`";
    $query = mysqli_query($conn, $sql);
    $res = mysqli_fetch_array($query);

    while($consulta = mysqli_fetch_array($query)){
        $consulta['status'] = $consulta['status'] == 1 ? 'ATIVO' : 'INATIVO';
        $ativo = $consulta['status'] == 'ATIVO' ? 'checked' : '';
        $inativo = $consulta['status'] == 'INATIVO' ? 'checked' : '';


        $resultado .= "
            <form method='post' action='atualizar_status.php'>
                <h2>Usuário</h2>
                    <input type='hidden' id='user' name='user' value='".$consulta['id']."'>
                    <p>Nome: ".$consulta['nome']." </p>
                    <p>Email: ".$consulta['email']." </p>
                    <p>Status: ". $consulta['status']." </p>
                <label>
                    <input type='radio' name='status' value='ativo' "
                    .$ativo." > Ativar
                </label>
                <label>
                    <input type='radio' name='status' value=inativo' "
                    . $inativo." > Desativar
                </label>
                <input type='submit' value='Salvar'>
            </form>
        
        ";
    }
    #echo "<meta http-equiv='refresh' content='0;url=admin.php'>";
}
