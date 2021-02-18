<?php

session_start();

if($_SESSION['logado'] != 'logado'){
    header("location:../../index.php");
}

//Capturar valores do formulário
$idveiculo = $_POST['idveiculo'];
$iddesp = $_POST['iddesp'];
$ododesp = $_POST['ododesp'];
$valordesp = $_POST['valordesp'];
$descdesp = $_POST['descdesp'];
$datadesp = $_POST['datadesp'];
$localdesp = $_POST['localdesp'];

//Conexão c/ banco de dados
include_once "../../conexao.php";

//Executar consulta de atualização no BD
$query = "UPDATE despesas SET ododesp='" . $ododesp . "',localdesp='" . $localdesp . "', datadesp='" . $datadesp . "', descdesp='" . $descdesp . "', valordesp='" . $valordesp . "' WHERE iddesp=" . $iddesp . ";";
$resultado = $conexao->query($query);
//fechar a conexão
$conexao->close();
//redirecionar para a listagem
if ($resultado) {
    //Redirecionar para a listagem
    header("location:despesa.php?id=$idveiculo");
} else {
    //Imprimir mensagem de erro
    die("Erro!");
}
?>