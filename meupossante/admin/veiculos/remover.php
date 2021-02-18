<?php
session_start();

if($_SESSION['logado'] != 'logado'){
	header("location: ../../index.php");
}

//Capturar o id do registro a ser removido
$id = $_GET["id"];

//Conexão com o banco de dados
include_once "../../conexao.php";

//Consulta de remoção no BD
$query = "DELETE FROM veiculos WHERE idveiculo=" . $id . ";";

//Executar consulta de acesso ao BD
$resultado = $conexao->query($query);

//Fechar conexão
$conexao->close();

if ($resultado) {
    //Redirecionar para a listagem
    header("location:../menu.php");
} else {
    //Imprimir mensagem de erro
}