<?php
//não mostrar erros para usuario
//ini_set('display_errors','');
//inicia sessão
session_start();
//verifica se o login foi realizado
if($_SESSION['logado'] != 'logado'){
	header("location:../../index.php");
	die();
}
$id = $_GET['id'];
include_once "../../conexao.php";
$query = "SELECT * FROM veiculos WHERE idveiculo=" . $id . ";";
$resultado = $conexao->query($query);
if ($resultado) {
	while ($linha = $resultado->fetch_assoc()) {
		$placa = $linha["placa"];
		$tanque = $linha["tanque"];
		$tipocomb = $linha["tipocomb"];
		$odoini = $linha['odoini'];
	}
}
$_SESSION['placa'] = $placa;
$total = 0;//total de gastos
$totaldesp = 0;//custo total de despesas
$totalaba = 0;//custo total de abastecimentos
$totalmanu = 0;//custo total de manutenções
$lastaba = 0;//último abatecimento registrado
$odoabaarray = array();//vetor de odometro abastecimento
$daarray = array();//vetor de data abastecimento
$dmarray = array();//vetor de data manutenção
$ddarray = array();//Vetor de data despesa
$fdaba = '1970-01-01';//primeira data abastecimento
$fddesp = '1970-01-01';//primeira data despesa
$fdmanu = '1970-01-01';//primeira data manutenção
$ldmanu = '1970-01-01';//última data manutenção
$lddesp = '1970-01-01';//última data despesa
$ldaba = '1970-01-01';//última data abastecimento
$fdata = '1970-01-01';//primeira data registrada
$ldata = '1970-01-01';//última data registrada
$registros = 0;
$dias = 0;//contagem de dias do 1o ao último registro
$odometro = 0;//distância total percorrida
$ododesp = 0;//distância total registrada nas despesas
$odomanu = 0;//distãncia total registrada nas manutenções
$odoaba = 0;//distância total registrada nos abastecimentos
$litrog = 0;//litros de gasolina
$litroa = 0;//litros de álcool
$litrod = 0;//litros de diesel
$litrogadt = 0;//litros gasolina aditivada
$litroaadt = 0;//litro alcool aditivado
$totalgas = 0;//valor total gasolina
$totalalc = 0;//valor total alcool
$totaldie = 0;//valor total diesel
$temmedia = 0;
$query = "SELECT valoraba, dataaba, odoaba, idcomb FROM abastecimentos WHERE idveiculo=" . $id . " ORDER BY dataaba DESC ;";
$resultado = $conexao->query($query);
if($resultado){
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()){
			if ($lastaba == 0) {
				$lastaba = $linha['valoraba'];
			}
			$totalaba += $linha['valoraba'];
			if($linha['idcomb'] == 1){
				$totalgas += $linha['valoraba'];
			} else if($linha['idcomb'] == 2){
				$totalalc += $linha['valoraba'];
			} elseif ($linha['idcomb'] == 3) {
				$totaldie += $linha['valoraba'];
			}
			$daarray[] = array(
				'da' => $linha['dataaba']
			);
			$odoabaarray[] = array(
				'odoaba' => $linha['odoaba']
			);
			$registros++;
		}
		$_SESSION['daarray'] = $daarray;
		$_SESSION['odoabaarray'] = $odoabaarray;
	}
}
$query = "SELECT valormanu, datamanu FROM manutencoes WHERE idveiculo=" . $id . " ;";
$resultado = $conexao->query($query);
if($resultado){
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()){
			$totalmanu += $linha['valormanu'];
			$dmarray[] = array(
				'dm' => $linha['datamanu']
			);
			$registros++;
		}
	}
}
$query = "SELECT valordesp, datadesp FROM despesas WHERE idveiculo=" . $id . " ;";
$resultado = $conexao->query($query);
if($resultado){
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()){
			$totaldesp += $linha['valordesp'];
			$ddarray[] = array( 
				'dd' =>$linha['datadesp']
			);
			$registros++;
		}
	}
}
//cálculo do total de gastos
$total = $totaldesp + $totalaba + $totalmanu;
//cálculo de dias
sort($daarray);//ordena crescente vetor abastecimento
sort($ddarray);//ordena crescente vetor despesa
sort($dmarray);//ordena crescente vetor manutenção
if($daarray){
$fdaba = $daarray[0]['da'];//captura data 1o abastecimento
$ldaba = $daarray[count($daarray)-1]['da'];//captura data último abastecimento
}
if($ddarray){
$fddesp = $ddarray[0]['dd'];//captura data 1a despesa
$lddesp = $ddarray[count($ddarray)-1]['dd'];//captura data última despesa
}
if($dmarray){
$fdmanu = $dmarray[0]['dm'];//captura data 1a manutenção
$ldmanu = $dmarray[count($dmarray)-1]['dm'];//captura data última manutenção
}
if($fdaba == '1970-01-01' && $fddesp == '1970-01-01' && $fdmanu == '1970-01-01'){
	$fdata = '1970-01-01';
} else if($fdaba == '1970-01-01' && $fddesp == '1970-01-01'){
	$fdata = $fdmanu;
} else if($fdaba == '1970-01-01' && $fdmanu == '1970-01-01'){
	$fdata = $fddesp;
} else if($fdmanu == '1970-01-01' && $fddesp == '1970-01-01'){
	$fdata = $fdaba;
} else if($fdmanu == '1970-01-01'){
	if($fdaba < $fddesp){
		$fdata = $fdaba;
	}else{
		$fdata = $fddesp;
	}
} else if($fddesp == '1970-01-01'){
	if($fdaba < $fdmanu){
		$fdata = $fdaba;
	}else{
		$fdata = $fdmanu;
	}
} else if($fdaba == '1970-01-01'){
	if($fddesp < $fdmanu){
		$fdata = $fddesp;
	}else{
		$fdata = $fdmanu;
	}
} else {
	if($fdaba < $fddesp){
		$fdata = $fdaba;
	}else{
		$fdata = $fddesp;
	}
	if($fdata > $fdmanu){
		$fdata = $fdmanu;
	}
}
if($ldaba > $lddesp){
	$ldata = $ldaba;
}else{
	$ldata = $lddesp;
}
if($ldata < $ldmanu){
	$ldata = $ldmanu;
}
$fdata = new DateTime ($fdata);
$ldata = new DateTime ($ldata);
$dias = $fdata->diff($ldata);

//cálculo de distância viajada
$query = "SELECT odoaba FROM abastecimentos WHERE idveiculo=" . $id . " ORDER BY odoaba DESC LIMIT 1 ;";
$resultado = $conexao->query($query);
if ($resultado) {
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()) {
			$odoaba = $linha['odoaba'];
		}
	} 
}
$query = "SELECT odomanu FROM manutencoes WHERE idveiculo=" . $id . " ORDER BY odomanu DESC LIMIT 1 ;";
$resultado = $conexao->query($query);
if ($resultado) {
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()) {
			$odomanu = $linha['odomanu'];
		}
	} 
}
$query = "SELECT ododesp FROM despesas WHERE idveiculo=" . $id . " ORDER BY ododesp DESC LIMIT 1 ;";
$resultado = $conexao->query($query);
if ($resultado) {
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()) {
			$ododesp = $linha['ododesp'];
		}
	} 
}
if($odoaba > $ododesp){
	$odometro = $odoaba;
}else{
	$odometro = $ododesp;
}
if($odometro < $odomanu){
	$odometro = $odomanu;
}
if($odometro != 0 ){
	$odometro = $odometro - $odoini;
}else{
	$odometro = 0;
}

//cálculo litros de gasolina
$query = "SELECT litro, idcomb FROM abastecimentos WHERE idveiculo=" . $id . "  ORDER BY dataaba DESC ;";
$resultado = $conexao->query($query);
if($resultado){
	if($resultado->num_rows > 0){
		while ($linha = $resultado->fetch_assoc()){
			if($linha['idcomb'] == 1){
				$litrog += $linha['litro'];
			} else if($linha['idcomb'] == 2){
				$litroa += $linha['litro'];
			} else if($linha['idcomb'] == 3){
				$litrod += $linha['litro'];
			}
		}
	}
}

//cálculo média de consumo de gasolina
$datamediaarray = array();//vetor de datas para média
$odomediaarray = array();//vetor odometro para media
$media = array();//vetor para guardar media
$litromedia = 0;//guarda litros para media
$query = "SELECT * FROM abastecimentos WHERE idveiculo=" . $id . " AND cheio = 1 ORDER BY dataaba DESC ;";
$resultado = $conexao->query($query);
if ($resultado) {
	if($resultado->num_rows > 0){
		while($linha = $resultado->fetch_assoc()){
			$datamediaarray[] = array(
				'datamedia' => $linha['dataaba']
			);
			$odomediaarray[] = array(
				'odomedia' => $linha['odoaba']
			);
		}
		for($i=1; $i < count($datamediaarray); $i++){
			$cont = 0;
			$litromedia = 0;
			$query1 = "SELECT * FROM `abastecimentos` WHERE dataaba BETWEEN '" . $datamediaarray[$i]['datamedia'] . "' AND '" . $datamediaarray[$i - 1]['datamedia'] . "' AND idveiculo =" . $id . " ORDER BY dataaba ASC;";
			$result = $conexao->query($query1);
			if($result){
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						if($cont == 0){
							$cont = 1;
						}else{
							$litromedia += $row['litro'];
						}
					}
				}
				$media[$i] = number_format(($odomediaarray[$i - 1]['odomedia'] - $odomediaarray[$i]['odomedia'])/$litromedia,3, ',', '.');
				$temmedia = 1;
			}
		}
		$_SESSION['media'] = $media;
		$_SESSION['odomediaarray'] = $odomediaarray;
	}
}


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
	<title><?= $placa ?></title>        
	<link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>    
	<link rel="stylesheet" type="text/css" href="../../css/style.css">   
</head>
<body>    
	<nav class="orange">
		<div class="nav-wrapper">
			<a href="#" class="center-align"><i class="sidenav-trigger material-icons  " data-target="slide-out">menu</i></a>
			<div><a href="#" class="brand-logo center"><img src="../../img/mp24px.png"/>  Meu Possante</a></div>     
		</div>
	</nav>       
	<ul id="slide-out" class="sidenav ">
		<li><div class="user-view orange">
			<a  href="#!" class="sidenav-close waves-effec" id="close" ><i style="color: white;" class="small material-icons">close</i></a>
			<a href="#name"><span class="white-text name center-align" style="font-size: 30px; margin-top: -2vh;" >Veículo</span></a>
			<a href="#user"><img class="circle center-align" style=" width: 150px;height: 150px; margin:auto; margin-top: 20px;" src="../../img/logo%20meu%20possante.png"></a>
			<a href="#name"><span style="margin-top: 0; padding-bottom: 1em;" class="white-text name center-align"><?=$placa?></span></a>    
		</div></li>
		<?php 
		echo "<li><a href='atualizaveiculo.php?id=" . $id . "'><i class='material-icons'>edit</i>Editar Veículo</a></li>";
		echo "<li><a href='#' onclick='remover(" . $id . ")'><i class='material-icons'>delete</i>Exluir Veículo</a></li>";
		echo "<li><a href='../menu.php?id=" . $id . "'><i class='material-icons'>reply</i>Voltar</a></li>";
		echo "<li><a href='../combustiveis/combustivel.php?id=" . $id . "'><i class='material-icons'>local_gas_station</i>Abastecimentos</a></li>";
		echo "<li><a href='../despesa/despesa.php?id=" . $id . "'><i class='material-icons'>attach_money</i>Despesas</a></li>";
		echo "<li><a href='../manutencao/manutencao.php?id=" . $id . "'><i class='material-icons'>build</i>Manutenções</a></li>";
		echo "<li><a href='../lembrete/lembrete.php?id=" . $id . "'><i class='material-icons'>today</i>Lembretes</a></li>";
		echo "<li><a href='../api/grafico.php?id=" . $id . "'><i class='material-icons'>equalizer</i>Gráficos</a></li>";
		echo "<li><a href='../veiculos/resumo.php?id=" . $id . "'><i class='material-icons'>description</i>Resumo</a></li>";
		echo "<li><a href='../sair.php?id=" . $id . "'><i class='material-icons'>highlight_off</i>Sair</a></li>";
		?>
	</ul>   
	<div class="container">
		<div>
			<h4 class="titulo">Resumo (<?=$placa?>)</h4>
			<h6 class="center">
				<?php 
				echo $registros . " registros em " . $dias->format('%a dias');
				?>
			</h6>
		</div>
		<h5 class="titulo">Resumo do Veículo</h5>
		<table>
			<tr>
				<th>Distânia Viajada</th>
				<th>Total de Gastos</th>
				<th>Custo/km</th>
			</tr>
			<tr>
				<td>
					<?php 
					echo $odometro . " km";
					?>
				</td>
				<td>
					<?= "R$ " . number_format($total, 2,',', '.') ?>
				</td>
				<td>
					<?php
					if($odometro != 0){ 
            $custopkm = ($total - $lastaba)/$odometro; //cálculo de custo por quilômetro
            echo "R$ " . number_format($custopkm, 2, ',', '.');
        } else {
        	echo "R$ 0,00";
        }
        ?>
    </td>
</tr>
</table>
<table>
	<tr>
		<th>km/dia</th>
		<th>Custo/dia</th>
		<th>Última Média (km/l)</th>
	</tr>
	<tr>
		<td>
			<?php 
			if(number_format($dias->format('%a'), 0, ',', '.') != 0){
				echo  number_format(($odometro) / $dias->format('%a'), 0, ',', '.') . " km";
			} else {
				echo "0 km";
			}
			?>
		</td>
		<td>
			<?php 
			if(number_format($dias->format('%a'), 0, ',', '.') != 0){
				echo "R$ " . number_format(($total - $lastaba) / $dias->format('%a'), 2, ',', '.');
			} else {
				echo "R$ 0,00";
			}
			?>
		</td>
		<td>
			<?php 
			if ($temmedia == 1) {
				echo $media[1] . " ";
				$temmedia = 0;
			}else{
				echo "0 ";
			}
			?>
			<a href="#" onclick="kpl()"><i class="material-icons" style="color: orange;">info</i></a>
		</td>
	</tr>
</table>
<h5 class="titulo">Resumo de Abastecimentos</h5>
<table>
	<tr>
		<th>Custo Total</th>
		<th> Total de Litros</th>
		<th>Abastecimento/Total</th>
	</tr>
	<tr>
		<td>
			R$ <?= number_format($totalaba, 2, ',', '.') ?>
		</td>
		<td>
			<?php 
			echo number_format($litrog + $litroa + $litrod, 3, ',', '.');
			?>
		</td>
		<td>
			<?php
			if($total != 0){
				echo number_format(($totalaba/$total) * 100, 2, ',', '.');
			} else{
				echo "0";
			}
			?> %
		</td>
	</tr>
</table>
<?php 
if ($totalgas == 0) {
	echo "<!--";
}
?>
<h6 class="titulo" >Gasolina</h6>
<table>
	<tr>
		<th>Custo Total</th>
		<th>Litros</th>
	</tr>
	<tr>
		<td>
			<?= "R$ " . number_format($totalgas, 2, ',', '.') ?>
		</td>
		<td>
			<?php 
			echo number_format($litrog, 3, ',', '.');
			?>
		</td>
	</tr>
</table>
<?php 
if ($totalgas == 0) {
	echo "-->";
}
if ($totalalc == 0) {
	echo "<!--";
}
?>
<h6 class="titulo">Álcool</h6>
<table>
	<tr>
		<th>Custo Total</th>
		<th>Litros</th>
	</tr>
	<tr>
		<td>
			<?= "R$ " . number_format($totalalc, 2, ',', '.') ?>
		</td>
		<td>
			<?= number_format($litroa, 3, ',', '.') ?>
		</td>
		<td></td>
	</tr>
</table>
<?php 
if ($totalalc == 0) {
	echo "-->";
}
if ($totaldie == 0) {
	echo "<!--";
}
?>
<h6 class="titulo">Diesel</h6>
<table>
	<tr>
		<th>Custo Total</th>
		<th>Litros</th>
	</tr>
	<tr>
		<td>
			<?= "R$ " . number_format($totaldie, 2, ',', '.') ?>
		</td>
		<td>
			<?= number_format($litrod, 3, ',', '.') ?>
		</td>
		<td></td>
	</tr>
</table>
<?php 
if ($totaldie == 0) {
	echo "-->";
}
?>
<h5 class="titulo">Resumo de Manutenções</h5>
<table>
	<tr>
		<th>Custo Total</th>
		<th>Manutenção/Total</th>
		<th>Custo/dia</th>
	</tr>
	<tr>	
		<td>
			<?php
			echo "R$ " .  number_format($totalmanu, 2, ',', '.') ;
			?>
		</td>
		<td>
			<?php
			if($total != 0){
				echo number_format(($totalmanu/$total)*100, 2, ',', '.');
			}else{
				echo "0";
			}
			?>
			%
		</td>
		<td>
			<?php 
			if(number_format($dias->format('%a'), 2, ',', '.') != 0){
				echo "R$ " . number_format($totalmanu / $dias->format('%a'), 2, ',', '.');
			} else {
				echo "R$ 0,00";
			}
			?>
		</td>
	</tr>
</table>
<h5 class="titulo">Resumo de Despesas</h5>
<table>	
	<tr>
		<th>Custo Total</th>
		<th>Despesas/Total</th>
		<th>Custo/dia</th>
	</tr>
	<tr>
		<td>
			<?= "R$ " . number_format($totaldesp, 2, ',', '.') ?>
		</td>
		<td>
			<?php
			if($total != 0){
				echo number_format(($totaldesp/$total)*100, 2, ',', '.');
			} else{
				echo "0";
			} 
			?>
			%
		</td>
		<td>
			<?php 
			if(number_format($dias->format('%a'), 2, ',', '.') != 0){
				echo "R$ " . number_format($totaldesp / $dias->format('%a'), 2, ',', '.');
			}else{
				echo "R$ 0, 00";
			}
			?>
		</td>
	</tr>
</table>
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
<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../js/remover.js"></script>
<script type="text/javascript" src="../../js/alerta.js"></script>
<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
<script>
	$(document).ready(function(){
		$('.sidenav').sidenav();
	});
</script>
</body>
</html>