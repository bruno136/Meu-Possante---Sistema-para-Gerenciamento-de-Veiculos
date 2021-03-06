<?php 
session_start();
/*if($_SESSION['logando']!= 'logando'){
  header("location: login.php");
}*/
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
  <title>Cadastro</title>
  <link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>
  <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
</head>
<body> 
 <nav class="orange">
  <div class="nav-wrapper">
    <div><a href="#" class="brand-logo center"><img src="../../img/mp24px.png"/>  Meu Possante</a></div>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="../../index.php" class="waves-effect waves-light btn">Voltar</a></li>
    </ul>
  </div>
</nav>
<ul class="sidenav" id="mobile-demo">
  <li><a href="../../index.php" class="waves-effect waves-light btn">Voltar</a></li>
</ul>
<main>
  <?php 
  $username = $_POST['username'];
  $senha = $_POST['senha'];
  $username = strtoupper($username);
  $senha = md5($senha);
  include_once "../../conexao.php";
  $query = "SELECT * FROM usuarios WHERE username = '$username' AND senha = '$senha'";
  $resultado = $conexao->query($query);
  if ($resultado) {
    if ($resultado->num_rows > 0) {
      $linha = $resultado->fetch_assoc();
      $id = $linha['idusuario'];
$_SESSION['username'] = $username;//salva o nome de usuario na sessão
$_SESSION['idusuario'] = $linha['idusuario'];//salva o id do usuario na sessão
if ($linha['username'] === $username && $linha['senha'] === $senha) {
 echo "<div class='center'><p>Login realizado com sucesso!</p><p>Por favor aguarde, estamos redirecionando para o menu...</p><img src='../../img/loading.gif'/></div>";
 $_SESSION['logado'] = 'logado';    
 header("refresh:3;../menu.php");
} 
}else {
 echo "<p>Login inválido</p><img src='../../img/atencao.png'/>";
 header("refresh: 2;login.php");
}
} 
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