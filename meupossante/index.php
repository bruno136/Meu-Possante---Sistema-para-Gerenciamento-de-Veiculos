<!DOCTYPE html>
<html lang="pt-br">
<head>
	 <meta charset="utf-8" name="theme-color" content="orange"/>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Meu Possante</title>
	<link rel="shortcut icon" href="img/mp24px.png" type="image/x-png"/>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<nav class="orange">
		<div class="nav-wrapper">
			<div><a href="#" class="brand-logo center"><img src="img/mp24px.png"/>  Meu Possante</a></div>
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li><a href="admin/cadastro/cadastro.php" class="waves-effect waves-light btn">Cadastrar</a></li>
				<li><a href="admin/login/login.php" class="waves-effect waves-light btn">Login</a></li>
			</ul>
		</div>
	</nav>

	<ul class="sidenav" id="mobile-demo">
		<a  href="#!" class="sidenav-close waves-effec" id="close" ><i class="small material-icons">close</i></a>
		<li><a href="admin/cadastro/cadastro.php" class="btn waves-effect ">Cadastrar</a></li>
		<li><a href="admin/login/login.php" class="btn waves-effect ">Login</a></li>
	</ul>

	<div class="section no-pad-bot" id="index-banner">
		<div class="container">
			<br>
			<h1 class="header center orange-text">Meu Possante</h1>
			<div class="row center">
				<h5 class="header col s12 light">É um Sistema Web,que ajuda você a gerenciar todas as informaçãoes relevantes sobre seus veículos como, por exemplo, combustível e manutenções. Com uma interface simples, limpa e profissional. Com ele você pode acompanhar e registrar a quilometragem, consumo de combustível, manutenções,<br>serviços e custos para o seu veículo. Ele permite atender todas as dificuldades de uma pessoa que não sabe o quanto gasta com seu veículo.</h5>
			</div>
     <!-- <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a> 
    </div>-->
    <br>

</div>
</div>
<div id="elements" class="scrollspy">
	<div class="row">
		<div class="col s12 pb-4 mt-7">
			<h1 class="mb-2 center font-weight-900 header center orange-text">Elementos do Sistema</h1>
			<div class="row center">
				<h5 class="header col s12 light">O sistema permite a visualização de dados por meio de tabela de preços de combustíveis, <br>
				gráficos que mostram o consumo e um mapa com a localização dos postos de gasolina.</h5>
			</div>
			<div class="padding-10 valign-wrapper">
				<div class="col s12 m12 l6 right-align">
					<img src="img/grafico.jpg" class="mr-10 responsive-img" width="350">
				</div>
				<div class="col s12 m12 l6 left">
					<h5 class="font-weight-900 orange-text">Gráficos</h5>
					<p>Mostra um comparativo médio <br> com diferentes tipos de gastos.</p>
				</div>
			</div>
			<div class="padding-10 valign-wrapper">
				<div class="col s12 m12 l6 right-align">
					<h5 class="font-weight-900 orange-text">Google Maps</h5>
					<p>Veja a localização dos postos <br> distribuídos pela cidade.</p>
				</div>
				<div class="col s12 m12 l6">
					<img src="img/imagem.png" class="ml-10 responsive-img" width="400">
				</div>
			</div>
			<div class="padding-10 valign-wrapper">
				<div class="col s12 m12 l6 right-align">
					<img src="img/Lembretes.png" class="mr-10 responsive-img" />
				</div>
				<div class="col s12 m12 l6 left">
					<h5 class="font-weight-900 orange-text">Lembretes</h5>
					<p>Tenha um controle sobre suas tarefas<br>registrando de forma prática.</p>
				</div>
			</div>
			<div class="padding-10 valign-wrapper">
				<div class="col s12 m12 l6 right-align">
					<h5 class="font-weight-900 orange-text">Gastos com Veículos</h5>
					<p>Tenha um maior controle de seus gastos<br> registrando-os de forma organizada.</p>
				</div>
				<div class="col s12 m12 l6">
					<img src="img/imagem1.png" class="ml-10 responsive-img" width="400">
				</div>
			</div>
		</div>
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
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
<script>
	$(document).ready(function(){
		$('.sidenav').sidenav();
	});
</script>
</body>
</html>