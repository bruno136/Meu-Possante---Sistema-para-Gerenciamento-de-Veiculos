 <?php 
 session_start();
 if($_SESSION['logado'] != 'logado'){
  header("location:../../index.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
	<title></title>
</head>
<body>
<div class="center"><p>Não há registros para construir o gráfico solicitado.</p></div>
</body>
</html>