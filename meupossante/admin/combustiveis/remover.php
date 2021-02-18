<?php

session_start();

if($_SESSION['logado'] != 'logado'){
    header("location:../../index.php");
}
//Capturar o id do registro a ser removido

$idveiculo = $_GET["idveiculo"];
$id = $_GET["id"];
//die ($id);
//Conexão com o banco de dados
include_once "../../conexao.php";

//Consulta de remoção no BD
$query = "DELETE FROM abastecimentos WHERE idaba=" . $id . ";";

//Executar consulta de acesso ao BD
$resultado = $conexao->query($query);

//Fechar conexão
$conexao->close();

if ($resultado) {
    //Redirecionar para a listagem
    header("location:combustivel.php?id=$idveiculo");
} else {
    //Imprimir mensagem de erro
}