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
   <div id="gastos" style="width: 98vw; height: 95vh;"></div>
  
<script type="text/javascript" src="../../js/graficos.js"></script>
</body>
</html>