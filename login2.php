<?php
#INICIANDO A SESSÃO
session_start();

#Conexão com o BD
require_once('conn.php');

#Variaves digitadas pelo usuario
$email = $_POST['email'];
$senha = $_POST['senha'];

#echo "Email: $email, e Senha:$senha";

#Verrificação das credenciais
$sql = "SELECT * FROM `login` WHERE `email` = '$email' AND `senha` = '$senha'";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) !== 1){
    #E-mail não cadastrado
    ?>
        <script>alert("E-mail: <?php echo $email; ?> ou a Senha esta incorreto, cadastre-se ou verrifique os dados!")</script>
        <meta http-equiv='refresh' content='0;url=login.php'>
    <?php
}else{
    #Criando a sessão e iniciando o sistema
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    #var_dump($query);
}
