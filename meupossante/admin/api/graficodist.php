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
    google.charts.setOnLoadCallback(distancia);

    function distancia() {
      var data = google.visualization.arrayToDataTable([
        ['Data', 'Distância'],
        <?php 
        include_once"../../conexao.php";
        $data = $_SESSION['daarray'];
        sort($data);
        $dist = $_SESSION['odoabaarray'];
        sort($dist);
        for($i = 0; $i < count($data); $i++){
          if($i == 0){
          echo "['" . date('d/m/y', strtotime($data[$i]['da'])) . "', " . ($dist[$i]['odoaba'] - $dist[$i]['odoaba']) . "], \n";
          }else{
          echo "['" . date('d/m/y', strtotime($data[$i]['da'])) . "', " . ($dist[$i]['odoaba'] - $dist[$i - 1]['odoaba']) . "], \n";
        }
       }
     ?>
     ]);
      var options = {
        title: 'Distância por Abastecimento',
        legend: {position: 'bottom'},
      
      };
      var chart = new google.visualization.ColumnChart(document.getElementById('dist'));
      chart.draw(data, options);
    }
  </script> 
   <div id="dist" style="width: 98vw; height: 95vh;"></div>
   <?php 

    ?>
  
<script type="text/javascript" src="../../js/graficos.js"></script>
</body>
</html>