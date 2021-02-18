<?php 
session_start();
if($_SESSION['logado'] != 'logado'){
    header("location:../../index.php");
}
$id = $_GET['id'];
$idveiculo = $_GET['idveiculo'];
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
 <title>Editar Abastecimento</title>
 <link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>
 <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
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
                <li><a href="combustivel.php?id=<?= $idveiculo ?>" class="waves-effect waves-light btn">Voltar</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="combustivel.php?id=<?= $idveiculo ?>" class="waves-effect waves-light btn">Voltar</a></li>
    </ul>
    <h4 class="center-align " style="color: orange;">Editar Abastecimento (<?=$_SESSION['placa']?>)</h4>
    <div class="valign-wrapper row login-box">
        <div class="col card  z-depth-1 grey lighten-4 s12  m6 pull-m3 l4 pull-l4" >
            <?php
        //Conectar com BD
            include_once "../../conexao.php";
        //Montar e executar consulta que recupera os valores relacionados ao ID atual
            $query = "SELECT * FROM abastecimentos WHERE idaba=" . $id . ";";
            $resultado = $conexao->query($query);   
            if ($resultado) {
               while ($linha = $resultado->fetch_assoc()) {
                $odoaba = $linha["odoaba"];
                $valoraba = $linha["valoraba"];
                $idcomb = $linha["idcomb"];
                $precoaba = $linha["precoaba"];
                $litro = $linha['litro'];
                $idposto = $linha["idposto"];
                $dataaba = $linha["dataaba"];
                $cheio = $linha["cheio"];
                $idveiculo = $linha['idveiculo'];
            }
            ?>
            <form action="processaatualizaabastecimento.php" method="post">
                <input type="hidden" value="<?= $idveiculo?>" name="idveiculo" id="idveiculo">
                <input type="hidden" value="<?= $id ?>" name="idaba" id="idaba"/>
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">description</i>
                            <label for="odoaba">Odômetro</label>
                            <input type="number" name="odoaba" value="<?= $odoaba ?>" required />
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">attach_money</i>
                            <label for="n1">Valor</label>
                            <input type="number" id="n1" step="0.01" min="0" name="valoraba" value="<?= $valoraba ?>" required />
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">attach_money</i>
                            <label for="n2">Preço</label>
                            <input type="number" name="precoaba" step="0.001" min="0.001" id="n2" value="<?= $precoaba ?>" onblur="calcular()" required />
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">local_drink</i>
                            <label for="resultado">Litros:</label>
                            <input type="number" step="0.001" min="0.001" value="<?= $litro ?>" name="litro" id="resultado" required />
                        </div>
                        <i class="material-icons prefix"></i>
                        <label for="combustivel">Combustível</label>
                        <select name='idcomb' id='combustivel'>              
                            <?php 
                            include_once "../../conexao.php";
                            $query = "SELECT * FROM combustiveis";
                            $resultado = $conexao->query($query);
                            if($resultado){
                              if($resultado->num_rows > 0) {
                                while($linha = $resultado->fetch_assoc()) {
                                   $comb[$linha['idcomb']] = $linha['tipocomb'];
                                   if($linha['idcomb'] == $idcomb) {
                                      echo "<option value='" . $linha["idcomb"] . "' checked='checked'>" .$comb[$linha['idcomb']]."</option><br>";
                                  }

                              }
                          }
                      }
                      $resultado = $conexao->query($query);
                      if($resultado){
                          if($resultado->num_rows > 0) {
                            while($linha = $resultado->fetch_assoc()) {                     
                                if($linha['idcomb'] != $idcomb){
                                    echo "<option value='" . $linha["idcomb"] . "'>" .$comb[$linha['idcomb']]."</option><br>";
                                } 
                            }
                        }
                    }                                 
                    ?>
                </select>
                <div class="input-field col s12">
                    <i class="material-icons prefix">calendar_today</i>
                    <label for="dataaba">Data</label>
                    <input type="date" value="<?= $dataaba ?>" name="dataaba" id="dataaba">
                </div>
                
                <i class="material-icons prefix"></i>
                <label for="cheio">Tanque Cheio</label>
                <select name="cheio" id="cheio" required>
                    <?php

                    if($cheio == 1){ 
                        echo "<option value='1' checked='checked'>sim</option>";
                        echo "<option value='0'>não</option>";
                    } else {
                        echo "<option value='0' checked='checked'>não</option>";
                        echo "<option value='1'>sim</option>";
                    }
                }
                ?>
            </select>
            <i class="material-icons prefix"></i>
            <label for="idposto">Local</label>
            <select name="idposto" id="local" required>
                <?php 
                $query = "SELECT * FROM postos ORDER BY nomeposto";
                $resultado = $conexao->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $postos[$linha['idposto']] = $linha['nomeposto'];
                            if($linha['idposto'] == $idposto){
                                echo "<option value='" . $linha["idposto"] . "' checked='checked'>" . $postos[$linha['idposto']] . "</option><br>";
                            }
                        } 
                    }
                }

                $resultado = $conexao->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            if($linha['idposto'] != $idposto){
                                echo "<option value='" . $linha["idposto"] . "'>" . $postos[$linha['idposto']] . "</option><br>";
                            }
                        } 
                    }
                }
                ?>
            </select>
            <div class="card-action right-align">
               
                <button class="btn waves-effect waves-light orange" type="submit" id="btEnviar" name="action">Salvar
                    <i class="material-icons right">save</i>
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