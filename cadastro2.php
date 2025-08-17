<?php
#print_r($_REQUEST);

#Conexão com o BD
require_once('conn.php');

#Dados do Formulario
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$c_senha= $_POST['confirmar_senha'];
$email = $_POST['email'];
#$email = 'email@email.com';

#echo 'Nome: '. $nome.'<br>E-mail: '.$email.'<br>Senha: '.$senha;

#Verificação no BD
$verificar_email = "SELECT * FROM login WHERE email = '$email'";
$resultado = mysqli_num_rows(mysqli_query($conn, $verificar_email));
#print_r ($resultado);

#Validação do resultado
if($resultado !== 0){
    ?>
        <script>alert("E-mail: <?php echo $email; ?>, Já esta cadastrado!<br> Vamos te Redirecionar para pagina de login!")</script>
        <meta http-equiv='refresh' content='0;url=login.php'>
    <?php
}else{
    #echo"Tudo Certo";
    #Cadastro do novo usuario
    # ADM Tipo = 1
    # Usuario Tipo = 2
    $cadastro_user = "INSERT INTO login (id, email, nome, senha, tipo) VALUES (NULL, '$email', '$nome', '$senha', '2')";
    $query = mysqli_query($conn, $cadastro_user);

    if(!$query){
        ?>
            <script>alert("ERROR: Usuario não cadastrado. Ternte Novamente!")</script>
            <meta http-equiv='refresh' content='0;url=cadastro.php'>
        <?php
    }else{
        #Obtendo o ID do email
        $sql = "SELECT `id` FROM `login` WHERE `email`='$email'";
        $query = mysqli_query($conn, $sql);
        $res = mysqli_fetch_array($query);
        $id = $res[0];

        $sql = "INSERT INTO `formas_pagamentos` (`id`, `id_usuario`, `dinheiro`, `pix`, `cartao`, `caderneta`) 
        VALUES (NULL, '$res[0]', 'aceita', 'aceita', 'aceita', 'não aceita')";
        $query = mysqli_query($conn, $sql);

        ?>
            <script>alert("Novo usuario cadastrado com sucesso!<br> Vamos te Redirecionar para pagina de login!")</script>
            <meta http-equiv='refresh' content='0;url=login.php'>
        <?php

    }
}