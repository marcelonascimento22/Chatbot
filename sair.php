<?php
#INICIANDO A SESSÃO
session_start();

#Excluindo a sessão
session_destroy();

echo '<meta http-equiv="refresh" content="0; url=login.php" />';
