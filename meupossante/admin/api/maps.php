<?php 
session_start();
if($_SESSION['logado'] != 'logado'){
	header("location:../index.php");
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
      include "../../conexao.php";
      $query = "SELECT * FROM postos ORDER BY nomeposto ;";
      $resultado = $conexao->query($query);
      if ($resultado) {
        if ($resultado->num_rows > 0) {
          while ($linha = $resultado->fetch_assoc()) {
            if($linha['idposto'] != 41){
             echo "var localizacao" . $linha['idposto'] . " = new google.maps.LatLng(" . $linha['lat'] . "," . $linha['lon'] . ");\n";
             echo "var posto" . $linha['idposto'] . " = new google.maps.Marker({position:localizacao" . $linha['idposto'] . ", icon:'../../img/twotone_local_gas_station_black_18dp.png'});\n";
             echo "posto" . $linha['idposto'] . ".setMap(map);\n";
             echo "  google.maps.event.addListener(posto". $linha['idposto'] .",'click',function() {";
             echo "var infowindow = new google.maps.InfoWindow({\n";
             echo "content: '" . $linha['nomeposto'] . "'\n";
             echo "});\n";
             echo "infowindow.open(map,posto" . $linha['idposto'] . ");\n";
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