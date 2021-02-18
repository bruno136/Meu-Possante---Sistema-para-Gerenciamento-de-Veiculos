		<?php 
	include_once"../../conexao.php";


	/*$query = "SELECT odoini from veiculos where idveiculo= 7 ;";
	$resultado = $conexao->query($query);
	if($resultado){
		$newarray = array();
		$dataini = '1970-01-01';
		if($resultado->num_rows > 0){
			while ($linha = $resultado->fetch_assoc()) {
				echo "[" . $linha['odoini'] . "],\n";
				$newarray[]= array(
					'odo'=>$linha['odoini'],
					'data'=> $dataini
				);

			}
		}
	}
	echo "<br>";
	print_r($newarray);
	echo "<br>";
	echo "<br>";
	echo "<br>";
*/

	$query = "SELECT odoaba, dataaba from abastecimentos where idveiculo= 7 ORDER BY dataaba DESC;";
	$resultado = $conexao->query($query);
	if($resultado){
				$newarray = array();
		if($resultado->num_rows > 0){
			while ($linha = $resultado->fetch_assoc()) {
				echo "[" . $linha['odoaba'] . "],\n";
				$newarray[]= array(
					'odo'=>$linha['odoaba'],
					'data'=>$linha['dataaba']
				);

			}
		}
	}
	echo "<br>";
	print_r($newarray);
	echo "<br>";
	echo "<br>";
	echo "<br>";

	$query = "SELECT odomanu, datamanu from manutencoes where idveiculo= 7 ORDER BY datamanu DESC;";
	$resultado = $conexao->query($query);
	if($resultado){
		if($resultado->num_rows > 0){
			while ($linha = $resultado->fetch_assoc()) {
				echo "[" . $linha['odomanu'] . "],\n";
				$newarray[]= array(
					'odo'=>$linha['odomanu'],
					'data'=>$linha['datamanu']
				);

			}
		}
	}
	echo "<br>";
	print_r($newarray);
	echo "<br>";
	echo "<br>";
	echo "<br>";

	$query = "SELECT ododesp, datadesp from despesas where idveiculo= 7 ORDER BY datadesp DESC;";
	$resultado = $conexao->query($query);
	if($resultado){
		if($resultado->num_rows > 0){
			while ($linha = $resultado->fetch_assoc()) {
				echo "[" . $linha['ododesp'] . "],\n";
				$newarray[]= array(
					'odo'=>$linha['ododesp'],
					'data'=>$linha['datadesp']
				);

			}
		}
	}
	echo "<br>";
	print_r($newarray);
	echo "<br>";
	echo "<br>";
	echo "<br>";

	asort($newarray);//ordena array crescente mantendo a chave
	print_r($newarray);//imprime array
	echo "<br>";
	echo "<br>";
	echo "<br>";
	sort($newarray);//ordena array crescente sem manter a chave
	print_r($newarray);
	echo "<br>";
	echo "<br>";
	echo "<br>";

echo $newarray[15]['data']." ".$newarray[4]['odo'];
	echo "<br>";
	echo "<br>";
	echo "<br>";
for($i=0;$i<count($newarray);$i++){
echo $newarray[$i]['odo'] . " " . $newarray[$i]['data'] . "<br>";
	
}
	?>


