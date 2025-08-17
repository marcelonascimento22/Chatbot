<?php
session_start();

require_once("conn.php");

error_reporting(0);
ini_set("display_errors", 0);

if($_SESSION['email'] == false || $_SESSION['senha'] == false){
  #Excluindo a sessão
  session_destroy();

  #echo '<meta http-equiv="refresh" content="0; url=login.php" />';
?>

  <script>
    window.location = "login.php";
  </script>

<?php
}
$email = $_SESSION['email'];
$sql = "SELECT * FROM `login` WHERE `email` = '$email' AND `tipo` = '2'";
$resultado = mysqli_num_rows(mysqli_query($conn, $sql));

if($resultado !== 0){
    #Definido o usuario como normal
    $adm = 0;
}else{
    #Definido o usuario com administrador
    $adm = 1;
}

