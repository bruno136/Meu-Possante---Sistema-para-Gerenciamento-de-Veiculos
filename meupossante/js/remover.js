function removerVeiculo(id){
	if(confirm("Confirmar exclusão?")){
		location.href = '../veiculos/remover.php?id=' + id;
	}
}

function remover(id){
	if(confirm("Confirmar exclusão?")){
		location.href = 'remover.php?id=' + id;
	} 
}

function removerInfo(a, b){
	if(confirm("Confirmar exclusão?")){
		location.href = 'remover.php?id=' + a + '&idveiculo=' + b;
	} 
}

