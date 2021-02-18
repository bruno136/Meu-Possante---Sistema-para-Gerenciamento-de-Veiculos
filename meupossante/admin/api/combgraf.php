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
       header("location:aviso.php");
       die();
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
   <div id="precos" style="width: 98vw; height: 95vh;"></div>
  
<script type="text/javascript" src="../../js/graficos.js"></script>
</body>
</html>