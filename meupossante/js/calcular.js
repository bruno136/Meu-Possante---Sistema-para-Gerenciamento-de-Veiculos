function calcular() {
 					var n1 = parseFloat(document.getElementById('n1').value, 10);
  					var n2 = parseFloat(document.getElementById('n2').value, 10);
  					document.getElementById('resultado').value = (n1 / n2).toFixed(3);
				}
