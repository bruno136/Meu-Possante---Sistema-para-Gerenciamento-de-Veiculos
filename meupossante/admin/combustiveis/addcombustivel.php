<?php
session_start();

if($_SESSION['logado'] != 'logado'){
	header("location:../../index.php");
}

$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" name="theme-color" content="orange"/>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<title>Adicionar Abastecimento</title>
	<link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<script>
		$(document).ready(function(){
			$('select').formSelect();
		});
	</script>
</head>
<body>
	<nav class="orange">
		<div class="nav-wrapper">
			<div><a href="#" class="brand-logo center"><img src="../../img/mp24px.png"/>  Meu Possante</a></div>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="combustivel.php?id=<?= $id ?>" class="waves-effect waves-light btn">Voltar</a></li>
			</ul>
		</div>
	</nav>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="combustivel.php?id=<?= $id ?>" class="waves-effect waves-light btn">Voltar</a></li>
	</ul>
	<h4 class="center-align " style="color: orange;">Dados do Abastecimento (<?=$_SESSION['placa']?>)</h4>
	<div class="valign-wrapper row login-box">
		<div class="col card  z-depth-1 grey lighten-4 s12  m6 pull-m3 l4 pull-l4">
			<form action="processaabastecimento.php" method="post">
				<input type="hidden" name="idveiculo" value="<?=$_GET['id']?>">
				<div class="card-content">
					<div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">description</i>
							<label for="odoaba">Odômetro</label>
							<input type="number" name="odoaba" min="0" id="odoaba" required>
						</div>
						<i class="material-icons prefix"></i>						
						<label for="combustivel">Combustível</label>
						<?php 
						include_once "../../conexao.php";
						echo "<select name='idcomb' id='combustivel' required >";
						$query = "SELECT * FROM combustiveis";
						$resultado = $conexao->query($query);
						if($resultado){
							if($resultado->num_rows > 0) {
								while($linha = $resultado->fetch_assoc()) {
									$comb[$linha['idcomb']] = $linha['tipocomb'];
									echo "<option value='" . $linha["idcomb"] . "'>" .$comb[$linha['idcomb']]."</option>";
								}
							}
						}
						echo "</select>";
						?>
						<div class="input-field col s12">
							<i class="material-icons prefix">attach_money</i>
							<label for="n1">Valor</label>
							<input type="number" id="n1" step="0.001" min="0.001" name="valoraba" value="" required />
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">attach_money</i> 
							<label for="n2">Preço</label>
							<input type="number" name="precoaba" step="0.001" min="0.001" id="n2" value="" onblur="calcular()" required /> 
						</div>
						<div class="input-field col s12">
							<i class="material-icons prefix">local_drink</i>
							<label for="resultado">Litros</label>
							<input  id="resultado" name="litro" step="0.001" min="0.001"  type="number" value="" required />
						</div>
						<i class="material-icons prefix"></i>
						<label for="tanque">Tanque Cheio</label>
						<select name="cheio" id="tanque" required>
							<option value="0">não</option>
							<option value="1">sim</option>
						</select>
						<div class="input-field col s12">
							<i class="material-icons prefix">calendar_today</i>
							<label for="data"></label>
							<input type="date" name="dataaba" id="data" required>
						</div>
						<label for="local">Local</label>
						<select name="idposto" id="local" required>
							<?php 
							$query = "SELECT * FROM postos ORDER BY nomeposto";
							$resultado = $conexao->query($query);
							if ($resultado) {
								if ($resultado->num_rows > 0) {
									while ($linha = $resultado->fetch_assoc()) {
										$postos[$linha['idposto']] = $linha['nomeposto'];
										echo "<option value='" . $linha["idposto"] . "'>" . $postos[$linha['idposto']] . "</option><br>";
									}
								} 
							}
							?>
						</select>
						<div class="card-action right-align">
							<button class="btn waves-effect waves-light orange" type="reset" id="reset" name="action">Redefinir
							</button>
							<button class="btn waves-effect waves-light orange" type="submit" id="btEnviar" name="action">Salvar
								<i class="material-icons right"></i>
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
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
	<script type="text/javascript" src="../../js/calcular.js"></script>
	<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.sidenav').sidenav();
		});
	</script>
</body>
</html>