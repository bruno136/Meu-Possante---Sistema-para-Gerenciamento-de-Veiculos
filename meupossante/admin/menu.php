<?php
//inicia sessão
session_start();
//verifica se o login foi realizado
if($_SESSION['logado'] != 'logado'){
  header("location:../index.php");
  die();
}
$idusuario = $_SESSION['idusuario']; 
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8" name="theme-color" content="orange"/>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <title>Início</title>        
 <link rel="shortcut icon" href="../img/mp24px.png" type="image/x-png"/>
 <link rel="stylesheet" type="text/css" href="../css/style.css"/>
</head>
<body>        
  <nav class="orange">
    <div class="nav-wrapper">
      <a href="#" class="center-align"><i class="sidenav-trigger material-icons  " data-target="slide-out">menu</i></a>
      <div><a href="#" class="brand-logo center"><img src="../img/mp24px.png"/>  Meu Possante</a>
      </div>
      <ul class="right hide-on-med-and-down"></ul>
    </div>            
  </nav>        
  <ul id="slide-out" class="sidenav">
    <li><div class="user-view orange">
     <a  href="#!" class="sidenav-close waves-effec" id="close" ><i style="color: white;" class="small material-icons">close</i></a>
     <a href="#name"><span class="white-text name center-align" style="font-size: 30px; margin-top: -2vh;" >Bem Vindo</span></a> 
     <a href="#user"><img class="circle center-align" style=" width: 150px; height: 150px; margin:auto; margin-top: 20px;" src="../img/logo%20meu%20possante.png"></a>
     <a href="#name"><span style="margin-top: 0;padding-bottom: 1em;" class="white-text name center-align"><?= $username ?></span></a>     
   </div></li>
   <li><a class="waves-effect" href="veiculos/addveiculo.php"><i class="material-icons">control_point</i>Inserir Veículo</a></li>
   <li><a href="cadastro/editar.php" class="waves-effect" ><i class="material-icons">lock_outline</i>Alterar Senha</a></li>
   <li><a href="sair.php" class="waves-effect" ><i class="material-icons">highlight_off</i>Sair</a></li>
   <!--<li><a  href="#!" class="sidenav-close" id="close" ><i class="material-icons">reply</i>Voltar</a></li> -->
   <li><div class="divider"></div></li>
   <li><a class="subheader"><i class="material-icons">drive_eta</i>Veículos</a></li>
   <?php 
   include_once "../conexao.php";
   $query = "SELECT * FROM veiculos WHERE idusuario = '$idusuario';";
   $resultado = $conexao->query($query);
   if($resultado){
    if($resultado->num_rows > 0){
      while($linha = $resultado->fetch_assoc()){
        echo "<li><a class='waves-effect' href='veiculos/resumo.php?id=" . $linha['idveiculo'] . "'>" . $linha["placa"] . "</a> </li>";
      }
    } else {
      echo "Você não possui veículos cadastrados!";
    }
  }
  ?>
</ul>  
<div class="centralizar">
  <div class="row">
   <h4 style="color: orange;" class="col s12 offset-s1 m6 offset-m3 l5 offset-l3">Onde Abastecer</h4>
 </div>
 <div style="margin:;" class="row">        	
  <a href="api/mapagasolina.php" target="mapa" class="waves-effect waves-light btn orange col s4 m3  l1 offset-l2 center-align"><div>Gasolina</div></a>
  <a href="api/mapaalcool.php" target="mapa" class="waves-effect waves-light btn orange col s4 m3  l1 offset-l1 center-align"><div>Alcool</div></a>
  <a href="api/mapadiesel.php" target="mapa" class="waves-effect waves-light btn orange col s4 m3  l1 offset-l1 center-align"><div>Diesel</div></a>
  <div class="col s12 m9  l9  center-align" style="height:70vh;">
   <iframe src="api/maps.php" style="margin-left: -1.5vw;width: 104%;height: 104%;" name="mapa" frameborder="0"></iframe>
 </div>   
 <div style="color: orange; font-weight:bolder;" class="col s12 m3 l2 offset-l1 center-align"><h5><i class="material-icons">event_note</i> Lembretes</h5></div>  
 <?php 
 $query = "SELECT lembretes.odolemb, lembretes.tipolemb, lembretes.datalemb, lembretes.desclemb, veiculos.placa FROM lembretes INNER JOIN veiculos WHERE lembretes.idveiculo = veiculos.idveiculo AND lembretes.idusuario=" . $idusuario . ";";
 $resultado = $conexao->query($query);
 if ($resultado) {
  if($resultado->num_rows > 0){
    while($linha = $resultado->fetch_assoc()){
      if($linha['tipolemb']){
        echo " <div class='destaque col s12 m3 l2 offset-l1  center-align'>Veículo (" . $linha['placa'] . "): " . $linha['desclemb'] . " com " . $linha['odolemb'] . " km</div>";
      } else{
        echo " <div class='destaque col s12 m3 l2 offset-l1  center-align'>Veículo (" . $linha['placa'] . "): " . $linha['desclemb'] . " em " . date('d/m/y',strtotime($linha['datalemb'])) . "</div>";
      }
    }
  } else {
    echo " <div class='destaque col s12 m3 l2 offset-l1  center-align'>Sem lembretes</div>";
  }
}else{
  echo "<div class='destaque col s12 m3 l2 offset-l1  center-align'>resultado falso</div>";
}
?> 
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
<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../materialize/js/materialize.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
<script>
  $(document).ready(function(){
    $('.sidenav').sidenav();
  });
</script>
</body>
</html>