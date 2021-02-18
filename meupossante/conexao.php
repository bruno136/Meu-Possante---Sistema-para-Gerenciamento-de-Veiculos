<?php 
$host = "127.0.0.1";
$user = "root";
$pass = "";
$banco = "meupossante";
$porta = 3306;
$conexao = mysqli_connect($host, $user, $pass,$banco,$porta) or die(mysqli_error());//variavel usada diversas vezes
//mysqli_select_db($conexao, $banco) or die(mysqli_error());
 ?>