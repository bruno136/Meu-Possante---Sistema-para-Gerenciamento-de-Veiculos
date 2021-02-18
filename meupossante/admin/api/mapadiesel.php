<?php 
session_start();
if($_SESSION['logado'] != 'logado'){
	header("location:../../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
 <div id="map" style="width:100%;height:95vh"></div>
 <table>
 </table>
 <script>
  function myMap() {
    var myCenter = new google.maps.LatLng(-20.146591, -44.888659);
    var mapCanvas = document.getElementById("map");
    var mapOptions = {
      center: myCenter, zoom: 15
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
    <?php
    include_once "../../conexao.php";
    $query1 = "SELECT * from postos ;";
    $result = $conexao->query($query1);
    if($result){
      if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
          $precoPosto[$row['idposto']] = 'não informado';

          $query = "SELECT postos.idposto, postos.nomeposto, abastecimentos.dataaba, abastecimentos.precoaba FROM abastecimentos INNER JOIN postos WHERE abastecimentos.idposto = postos.idposto and abastecimentos.idcomb = 3   and abastecimentos.idposto = " . $row['idposto'] ." order by dataaba desc limit 1;";
          $resultado = $conexao->query($query);
          if ($resultado) {
            if ($resultado->num_rows > 0) {
              while ($linha = $resultado->fetch_assoc()) {
                $precoPosto[$row['idposto']] = str_replace('.',',',$linha['precoaba']);
              }
            }
          }
          if($row['idposto'] != 41){
           echo "var localizacao" . $row['idposto'] . " = new google.maps.LatLng(" . $row['lat'] . "," . $row['lon'] . ");\n";
           echo "var posto" . $row['idposto'] . " = new google.maps.Marker({position:localizacao" . $row['idposto'] . ", icon:'../../img/twotone_local_gas_station_black_18dp.png'});\n";
           echo "posto" . $row['idposto'] . ".setMap(map);\n";
           echo "  google.maps.event.addListener(posto". $row['idposto'] .",'click',function() {";
           echo "var infowindow = new google.maps.InfoWindow({\n";
           if($precoPosto[$row['idposto']] != 'não informado'){
            echo "content:'" . $row['nomeposto'] . "<br>Diesel R$ " . $precoPosto[$row['idposto']] . "'\n";
          } else {
            echo "content:'" . $row['nomeposto'] . "<br>Valor " . $precoPosto[$row['idposto']] . "'\n";
          }
          echo "});\n";
          echo "infowindow.open(map,posto" . $row['idposto'] . ");\n";
          echo "});";
        }
      }
    }
  }
  ?>
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1anN_hb2egfclnOAWr5OQGm8KNJC9UgA&callback=myMap"></script>
</body>
</html>