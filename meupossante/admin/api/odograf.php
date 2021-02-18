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
       }else{
         header("location:aviso.php");
         die();
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
  <div id="odometro" style="width: 98vw; height: 95vh;"></div>
  
  <script type="text/javascript" src="../../js/graficos.js"></script>
</body>
</html>