<?php
session_start();
if ($_SESSION['logado'] != 'logado') {
	header("location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" name="theme-color" content="orange">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Adicionar Lembrete</title>
	<link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>
	 <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
</head>
<body>
	<nav class="orange">
		<div class="nav-wrapper">
			<div><a href="#" class="brand-logo center"><img src="../../img/mp24px.png"/>  Meu Possante</a></div>
		</div>
	</nav>
<main>
<?php 
//Capturar valores do formulário
$idveiculo = $_POST["idveiculo"];
$odolemb = $_POST["odolemb"];
$desclemb = $_POST["desclemb"];
$datalemb = $_POST["datalemb"];
$idusuario = $_POST["idusuario"];
$tipolemb = $_POST['tipolemb'];
//Conexão c/ banco de dados
include "../../conexao.php";
$query = "INSERT INTO lembretes(idveiculo, idusuario, odolemb, datalemb, desclemb, tipolemb) VALUES('" . $idveiculo . "','" . $idusuario . "','" . $odolemb . "','" . $datalemb . "','" . $desclemb . "','" . $tipolemb . "');";
$resultado = $conexao->query($query);
//fechar a conexão
$conexao->close();
echo "<div class='center'><p>Lembrete inserido com sucesso!</p><img src='../../img/atencao.png'/></div>";
header("refresh: 2;lembrete.php?id=$idveiculo");
 ?>
</main>
<footer class="page-footer orange">
		<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Sobre</h5>
					<p class="grey-text text-lighten-4">Sistema web que visa auxiliar as pessoas no controle de seus gastos gerados por veículos de sua propriedade.</p>
				</div>
				<div class="col l3 s12">
					<h5 class="white-text">Grupo</h5>
					<ul>
						<li><a class="white-text" href="#!">Bruno Macedo</a></li>
						<li><a class="white-text" href="#!">Leonardo Barbosa</a></li>
						<li><a class="white-text" href="#!">Rosimeire Corrêa</a></li>
						<li><a class="white-text" href="#!">Silvanderson Santos</a></li>
					</ul>
				</div>
				<div class="col l3 s12">
					<h5 class="white-text">Orientadores</h5>
					<ul>
						<li><a class="white-text" href="#!">Breno Sousa</a></li>
						<li><a class="white-text" href="#!">Thiago Magela</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				Todos os direitos reservados. <a class="orange-text text-lighten-3" href="http://materializecss.com">Meu Possante 2018©</a>
			</div>
		</div>
	</footer>
	<a href="https://icons8.com"></a>
	<!--JavaScript at end of body for optimized loading-->
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.sidenav').sidenav();
		});
	</script>
</body>
</html>