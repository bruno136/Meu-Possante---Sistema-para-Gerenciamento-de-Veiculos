<?php

session_start();

if($_SESSION['logado'] != 'logado'){
    header("location:../../index.php");
}

//Capturar valores do formulário
$id = $_POST['idveiculo'];
$idaba = $_POST['idaba'];
$odoaba = $_POST['odoaba'];
$valoraba = $_POST['valoraba'];
$precoaba = $_POST['precoaba'];
$idcomb = $_POST['idcomb'];
$litro = $_POST['litro'];
$idposto = $_POST['idposto'];
$dataaba = $_POST['dataaba'];
$cheio = $_POST['cheio'];
//Conexão c/ banco de dados
include_once "../../conexao.php";

//Executar consulta de atualização no BD
$query = "UPDATE abastecimentos SET odoaba='" . $odoaba . "', cheio='" . $cheio . "', dataaba='" . $dataaba . "', idposto='" . $idposto . "', litro='" . $litro . "', precoaba='" . $precoaba . "', valoraba='" . $valoraba . "',idcomb='" . $idcomb . "' WHERE idaba=" . $idaba . ";";
$resultado = $conexao->query($query);
//fechar a conexão
$conexao->close();
//redirecionar para a listagem
if ($resultado) {
    //Redirecionar para a listagem
    header("location:combustivel.php?id=$id");
} else {
    //Imprimir mensagem de erro
    die("Erro!");
}
?>