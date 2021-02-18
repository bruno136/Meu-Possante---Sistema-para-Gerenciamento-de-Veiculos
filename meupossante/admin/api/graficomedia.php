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
   google.charts.setOnLoadCallback(media);

   function media() {
    var data = google.visualization.arrayToDataTable([
      ['Odômetro', 'Média'],
      <?php 
      include_once"../../conexao.php";
      $odomediaarray = $_SESSION['odomediaarray'];
      $media = $_SESSION['media'];     
      for($i = 1; $i <= count($media); $i++){
        echo "[" . $odomediaarray[$i - 1]['odomedia'] . ", " . str_replace(',', '.', $media[$i]) . "], \n";
      } 
      ?>
      ]);
    var options = {
      title: 'Média (km/l)',
      legend: {position: 'bottom'},    
    };
    var chart = new google.visualization.AreaChart(document.getElementById('media'));
    chart.draw(data, options);
  }
</script> 
<div id="media" style="width: 98vw; height: 95vh;"></div>
<?php 

?>

<script type="text/javascript" src="../../js/graficos.js"></script>
</body>
</html>