<?php 
session_start();//chama a sessão
session_destroy();// destroi a sessão
header("location:../index.php");//volta para a pagina de login
 ?>