<?php
session_start();
if($_SESSION['logado'] != 'logado'){
	header("location:../../index.php");
}
//Capturar valores do formulário
$placa = $_POST["placa"];
$tanque = $_POST["tanque"];
$tipocomb = $_POST["tipocomb"];
$id = $_POST["idveiculo"];
$odoini = $_POST['odoini'];
//Conexão c/ banco de dados
include_once "../../conexao.php";
//Executar consulta de atualização no BD
$query = "UPDATE veiculos SET placa='" . $placa . "',odoini='" . $odoini ."', tanque='" . $tanque . "',tipocomb='" . $tipocomb . "' WHERE idveiculo=" . $id . ";";
$resultado = $conexao->query($query);
//fechar a conexão
$conexao->close();
//redirecionar para a listagem
if ($resultado) {
    //Redirecionar para a listagem
	header("location:resumo.php?id=$id");
} else {
    //Imprimir mensagem de erro
	die("Erro!");
}