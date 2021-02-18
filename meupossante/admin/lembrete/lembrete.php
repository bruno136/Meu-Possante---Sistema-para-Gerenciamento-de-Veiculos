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
  <meta charset="utf-8" name="theme-color" content="orange">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
  <title>Lembretes (<?= $_SESSION['placa'] ?>)</title>        
  <link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>  
  <link rel="stylesheet" type="text/css" href="../../css/style.css">  
</head>
<body>    
  <nav class="orange">
    <div class="nav-wrapper">
      <a href="#" class="center-align"><i class="sidenav-trigger material-icons  " data-target="slide-out">menu</i></a>
      <div><a href="#" class="brand-logo center"><img src="../../img/mp24px.png"/>Meu Possante</a></div>
    </div>
  </nav>       
  <ul id="slide-out" class="sidenav ">
    <li><div class="user-view orange">
      <a  href="#!" class="sidenav-close waves-effec" id="close" ><i style="color: white;" class="small material-icons">close</i></a>
      <a href="#name"><span class="white-text name center-align" style="font-size: 30px; margin-top: -2vh;" >Veículo</span></a>
      <a href="#user"><img class="circle center-align" style=" width: 150px;height: 150px; margin:auto; margin-top: 20px;" src="../../img/logo%20meu%20possante.png"></a>
      <a href="#name"><span style="margin-top: 0; padding-bottom: 1em;" class="white-text name center-align"><?=$_SESSION['placa']?></span></a>    
    </div></li>
    <?php 
    echo "<li><a href='../veiculos/atualizaveiculo.php?id=" . $id . "'><i class='material-icons'>edit</i>Editar Veículo</a></li>";
    echo "<li><a href='#' onclick='removerVeiculo(" . $id . ")'><i class='material-icons'>delete</i>Exluir Veículo</a></li>";
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
  <main class="">
    <div class="container"> 
      <h4><a href="add.php?id=<?= $id?>"  style="color:orange;"><i class="material-icons">control_point</i>Lembretes (<?=$_SESSION['placa']?>)</a></h4>
			<?php 
			include "../../conexao.php";
			$query = "SELECT * FROM lembretes WHERE idveiculo = '$id' ORDER BY datalemb DESC;";
            $resultado = $conexao->query($query);
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                        echo "<div><div class='row'>";
                        echo("<div class='atributos offset-xl1 col s11 m4 offset-m1 xl4'><b>Odômetro: </b>" . $linha["odolemb"] . " km</div><div class='atributos col s11 m4 xl4'><b>Data: </b>" . date("d/m/Y", strtotime($linha['datalemb'])) . "</div><div class='atributos  offset-xl1 col s11 m8 offset-m1 xl8'><b>Descrição: </b>" . $linha["desclemb"] . "</div><a href='editar.php?id=" . $linha["idlemb"] . "&idveiculo=".$linha["idveiculo"]."'><div class='atributos col s3 offset-s2 m2 offset-m3 xl1 offset-xl3 center-align'><i style='font-size: 16px;' class='material-icons'>edit</i></div></a><a href='#' onclick='removerInfo(" . $linha["idlemb"] .", " .$id . ")'><div class='atributos col s3 offset-s1 m2 xl1  offset-xl2 center-align'><i style='font-size: 16px;' class='material-icons'>delete</i></div></a>");
                        echo "<div class='divisao col s11 m8 offset-m1 xl8 offset-xl1'></div></div></div>";
                    }
                } else {
                    echo "<div class='center'><p>Nenhum registro encontrado!</p><img src='../../img/atencao.png'/>";
                }
            } else {
                die("Erro!");
            }

            $conexao->close();
		 ?>
</div>
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
<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../js/remover.js"></script>
<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
<script>
  $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>
</body>
</html>