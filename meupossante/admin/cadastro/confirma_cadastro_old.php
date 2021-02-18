<?php 
session_start();
if($_SESSION['cadastrando'] != 'cadastrando'){
  header("location:../../index.php");
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
        <li><a href="../login/login.php" class="waves-effect waves-light btn">Entrar</a></li>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="mobile-demo">
    <li><a href="principale.html" class="waves-effect waves-light btn">Voltar</a></li>
    <li><a href="login.html" class="waves-effect waves-light btn">Entrar</a></li>
  </ul>
  <main>
   <?php 
   $nome = $_POST['nome'];
   $senha = $_POST['senha'];
   $confirmar = $_POST['confirmar'];
   $username = $_POST['username'];
   $sobrenome = $_POST['sobrenome'];
   $cont = 0;

   include_once "../../conexao.php";

   if ($senha === $confirmar) {
    $cont = 1;
  }else{
    echo "<div class='center-align'><p>Senha e confirmação são diferentes.</p><p>Por favor tente novamente.</p><img src='../../img/atencao.png'/></div>";	
    $cont = 2;
  }

  if($cont === 1){
    if (empty($senha) || empty($nome) || empty($sobrenome) || empty($username)) {
      echo "preencha os campos";
      die();
    }
    $username = strtoupper($username);
    $senha = md5($senha);
    $query = "INSERT INTO usuarios (nome,sobrenome,senha,username) VALUES('" . $nome . "', '" . $sobrenome . "','" . $senha . "','" . $username . "');";
    $resultado = $conexao->query($query);

//fechar a conexão
    $conexao->close();

    if ($resultado) {
     echo "<div class='center-align'><p>Cadastro realizado com sucesso!!!</p><p>Seu nick é: " . $username . "</p><p>Por favor aguarde, processando dados</p><img src='../../img/loading.gif'/></div>";
     session_destroy();
     header("refresh:3;../login/login.php");
     
   } else {
    //Imprimir mensagem de erro
    echo "<p>Nome de usuário já cadastrado.</p><p>Por favor, escolha um outro nome de usuário.</p><img src='../../img/atencao.png'/>";
    header("refresh:3;cadastro.php");
    //die();
  }
  

}else if($cont === 2){
	session_destroy();
	header("refresh:3;cadastro.php");
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