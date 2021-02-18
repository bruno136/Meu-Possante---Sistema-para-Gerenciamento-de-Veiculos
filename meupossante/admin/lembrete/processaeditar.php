<?php

session_start();

if($_SESSION['logado'] != 'logado'){
    header("location:../../index.php");
}

//Capturar valores do formulário
$idveiculo = $_POST['idveiculo'];
$idlemb = $_POST['idlemb'];
$odolemb = $_POST['odolemb'];
$desclemb = $_POST['desclemb'];
$datalemb = $_POST['datalemb'];
$idusuario = $_POST["idusuario"];

//Conexão c/ banco de dados
include_once "../../conexao.php";

//Executar consulta de atualização no BD
$query = "UPDATE lembretes SET odolemb='" . $odolemb . "', datalemb='" . $datalemb . "', desclemb='" . $desclemb . "' WHERE idlemb=" . $idlemb . ";";
$resultado = $conexao->query($query);
//fechar a conexão
$conexao->close();
//redirecionar para a listagem
if ($resultado) {
    //Redirecionar para a listagem
    header("location:lembrete.php?id=$idveiculo");
} else {
    //Imprimir mensagem de erro
    die("Erro!");
}
?>