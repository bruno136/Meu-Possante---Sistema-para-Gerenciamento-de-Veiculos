 <?php 
 session_start();
 if($_SESSION['logado'] != 'logado'){
  header("location:../../index.php");
  die();
}
$id = $_GET['id'];
?>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>

  <iframe src="" frameborder="0"></iframe>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(combGraf);

    function combGraf() {
      var data = google.visualization.arrayToDataTable([
       // ['Data', 'Gasolina'],
        <?php 
        include_once"../../conexao.php";
        $cont = 0;
        $query = "SELECT precoaba, dataaba, idcomb from abastecimentos where idveiculo=" . $id . " and idcomb=".$_GET['idcomb']."  ORDER BY dataaba asc;";
        $resultado = $conexao->query($query);
        if($resultado){
         if($resultado->num_rows > 0){
          while ($linha = $resultado->fetch_assoc()) {
            if($linha['idcomb'] == 1 && $cont == 0){
              echo "['Data', 'Gasolina'],";
              $cont = 1;
            } else if($linha['idcomb'] == 2 && $cont == 0){
              echo "['Data', 'Álcool'],";
              $cont = 1;
            } else if($linha['idcomb'] == 3 && $cont == 0){
              echo "['Data', 'Diesel'],";
              $cont = 1;
            }
           echo "['" . date('d/m/y',strtotime($linha['dataaba'])) . "', " . $linha['precoaba'] . "],\n";
         }
         
       }else{
        $cont = 0;
        $query = "SELECT precoaba, dataaba, idcomb from abastecimentos where idveiculo=" . $id . " and idcomb=2 ORDER BY dataaba DESC;";
        $resultado = $conexao->query($query);
        if($resultado){
         if($resultado->num_rows > 0){
          while ($linha = $resultado->fetch_assoc()) {
            if($linha['idcomb'] == 1 && $cont == 0){
              echo "['Data', 'Gasolina'],";
              $cont = 1;
            } else if($linha['idcomb'] == 2 && $cont == 0){
              echo "['Data', 'Álcool'],";
              $cont = 1;
            } else if($linha['idcomb'] == 3 && $cont == 0){
              echo "['Data', 'Diesel'],";
              $cont = 1;
            }
           echo "['" . date('d/m/y',strtotime($linha['dataaba'])) . "', " . $linha['precoaba'] . "],\n";
         }
         
       }else{
        $cont = 0;
        $query = "SELECT precoaba, dataaba, idcomb from abastecimentos where idveiculo=" . $id . " and idcomb=3 ORDER BY dataaba DESC;";
        $resultado = $conexao->query($query);
        if($resultado){
         if($resultado->num_rows > 0){
          while ($linha = $resultado->fetch_assoc()) {
            if($linha['idcomb'] == 1 && $cont == 0){
              echo "['Data', 'Gasolina'],";
              $cont = 1;
            } else if($linha['idcomb'] == 2 && $cont == 0){
              echo "['Data', 'Álcool'],";
              $cont = 1;
            } else if($linha['idcomb'] == 3 && $cont == 0){
              echo "['Data', 'Diesel'],";
              $cont = 1;
            }
           echo "['" . date('d/m/y',strtotime($linha['dataaba'])) . "', " . $linha['precoaba'] . "],\n";
         }
         
       }
     }
       }
     }
       }
     }
     ?>
     ]);
      var options = {
        title: 'Preço do Combustível',
        legend: {position: 'bottom'},
      };
      var chart = new google.visualization.LineChart(document.getElementById('precos'));
      chart.draw(data, options);
    }
  </script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(gastosGraf);

    function gastosGraf() {
      var data = google.visualization.arrayToDataTable([
        ['Categoria', 'Valor'],
        <?php 
        $abastecimentos = 0;
        $despesas = 0;
        $manutencoes = 0;
        include_once"../../conexao.php";
        $query = "SELECT valoraba from abastecimentos where idveiculo=" . $id . " ;";
        $resultado = $conexao->query($query);
        if($resultado){
         if($resultado->num_rows > 0){
          while ($linha = $resultado->fetch_assoc()) {
           $abastecimentos += $linha['valoraba'];
         }
       }
     }

     $query = "SELECT valordesp from despesas where idveiculo=" . $id . " ;";
     $resultado = $conexao->query($query);
     if($resultado){
       if($resultado->num_rows > 0){
        while ($linha = $resultado->fetch_assoc()) {
         $despesas += $linha['valordesp'];
       }
     }
   }

   $query = "SELECT valormanu from manutencoes where idveiculo=" . $id . " ;";
   $resultado = $conexao->query($query);
   if($resultado){
     if($resultado->num_rows > 0){
      while ($linha = $resultado->fetch_assoc()) {
       $manutencoes += $linha['valormanu'];
     }
   }
 }

 echo "['Manutenções', " . $manutencoes . "],\n['Despesas', " . $despesas . "],\n['Abastecimentos', " . $abastecimentos . "]\n";
 ?>
 ]);

      var options = {
        title: 'Gastos por Categoria (R$)',
        pieHole: 0.4
      };

      var chart = new google.visualization.PieChart(document.getElementById('gastos'));

      chart.draw(data, options);
    }
  </script>

  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(odoGraf);
function odoGraf() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Odômetro'],
    <?php 
        include_once"../../conexao.php";
        $query = "SELECT odoaba, dataaba from abastecimentos where idveiculo=" . $id . " ORDER BY odoaba ASC;";
        $resultado = $conexao->query($query);
        if($resultado){
         if($resultado->num_rows > 0){
          while ($linha = $resultado->fetch_assoc()) {
           echo "['" . date('d/m/y',strtotime($linha['dataaba'])) . "', " . $linha['odoaba'] . "],\n";

         }
       }
     }
     ?>
        ]);

        var options = {
        title: 'Odômetro',
        legend:{position:'bottom'},
      };

      var chart = new google.visualization.AreaChart(document.getElementById('odometro'));

      chart.draw(data, options);
    }
    
  </script>
  <div id="precos" style="width: 900px; height: 500px"></div>
  <div id="gastos" style="width: 900px; height: 500px"></div>
  <div id="odometro" style="width: 900px; height: 500px"></div>
<script type="text/javascript" src="../../js/graficos.js"></script>
</body>
</html>
