<?php
#INICIANDO A SESSÃO
session_start();

#Conexão com o BD
require_once('conn.php');

#Obtendo o ID do usuario logado
$email = $_SESSION['email'];
$sql = "SELECT `id` FROM `login` WHERE `email`='$email'";
$query = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($query);
$id = $res[0];

$sql = "SELECT `dinheiro`, `pix`, `cartao`, `caderneta` FROM `formas_pagamentos` WHERE `id_usuario` = $id";
$query = mysqli_query($conn, $sql);
$res = mysqli_fetch_array($query);

