<?php
session_start();
if($_SESSION['logado'] != 'logado'){
    header("location:../../index.php");
}
//Capturar valores do formulário
$idveiculo = $_POST['idveiculo'];
$idmanu = $_POST['idmanu'];
$odomanu = $_POST['odomanu'];
$valormanu = $_POST['valormanu'];
$descmanu = $_POST['descmanu'];
$datamanu = $_POST['datamanu'];
//Conexão c/ banco de dados
include "../../conexao.php";
//Executar consulta de atualização no BD
$query = "UPDATE manutencoes SET odomanu='" . $odomanu . "', datamanu='" . $datamanu . "', descmanu='" . $descmanu . "', valormanu='" . $valormanu . "' WHERE idmanu=" . $idmanu . ";";
$resultado = $conexao->query($query);
//fechar a conexão
$conexao->close();
//redirecionar para a listagem
if ($resultado) {
    //Redirecionar para a listagem
    header("location:manutencao.php?id=$idveiculo");
} else {
    //Imprimir mensagem de erro
    die("Erro!");
}
?>