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
    <meta charset="utf-8" name="theme-color" content="orange">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../materialize/css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Editar Lembrete</title>
    <link rel="shortcut icon" href="../../img/mp24px.png" type="image/x-png"/>
    <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
</head>
<body>
    <nav class="orange">
        <div class="nav-wrapper">
            <div><a href="#" class="brand-logo center"><img src="../../img/mp24px.png"/>  Meu Possante</a></div>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="lembrete.php?id=<?= $idveiculo ?>" class="waves-effect waves-light btn">Voltar</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="lembrete.php?id=<?= $idveiculo ?>" class="waves-effect waves-light btn">Voltar</a></li>
    </ul>
    <h4 class="center-align " style="color: orange;">Editar Lembrete (<?=$_SESSION['placa']?>)</h4>
    <div class="valign-wrapper row login-box">
        <div class="col card  z-depth-1 grey lighten-4 s12  m6 pull-m3 l4 pull-l4" >

            <?php
        //Conectar com BD
            include_once "../../conexao.php";
        //Montar e executar consulta que recupera os valores relacionados ao ID atual
            $query = "SELECT * FROM lembretes WHERE idlemb=" . $id . ";";
            $resultado = $conexao->query($query);
            
            if ($resultado) {
             while ($linha = $resultado->fetch_assoc()) {
                $odolemb = $linha["odolemb"];
                $desclemb = $linha["desclemb"];
                $datalemb = $linha["datalemb"];
                $idlemb = $linha["idlemb"];
                $idusuario = $linha["idusuario"];
                $tipolemb = $linha["tipolemb"];
            }
            ?>
            <form action="processaeditar.php" method="post">
                <input type="hidden" value="<?= $idveiculo?>" name="idveiculo" id="idveiculo">
                <input type="hidden" value="<?= $idlemb ?>" name="idlemb" id="idlemb"/>
                <input type="hidden" value="<?= $idusuario ?>" name="idusuario" />
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">description</i>
                            <label for="odolemb">Odômetro (km)</label>
                            <input type="number" name="odolemb" value="<?= $odolemb ?>" />
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">description</i>
                            <label for="desclemb">Descrição</label>
                            <textarea name="desclemb" id="desclemb" cols="30" rows="10"><?=$desclemb?></textarea>
                        </div>
                            <label for="datalemb">Data prevista</label><br>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">calendar_today</i>
                            <input type="date" value="<?= $datalemb ?>" name="datalemb" id="datalemb" />
                        </div>
                            <label for="tipolemb">Lembrar por</label>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">dns</i>
                            <select name="tipolemb" id="tipolemb" required>
                                <?php 
                                    if($tipolemb == 0){
                                        echo "<option value='0'>Data</option><br><option value='1'>Odômetro</option>";
                                    } else {
                                        echo "<option value='1'>Odômetro</option><br><option value='0'>Data</option>";
                                    }
                                 ?>
                            </select>
                        </div>
                    </div>
                </div>  
                <div class="card-action right-align">
                    <button class="btn waves-effect waves-light orange" type="submit" id="btEnviar" name="action">Salvar<i class="material-icons right">save</i>
                    </button>
                </div>
            </form>
            <?php
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
<a href="https://icons8.com"></a>
<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../../materialize/js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>
<script>
        $(document).ready(function(){
            $('select').formSelect();
        });
    </script>
</body>
</html>