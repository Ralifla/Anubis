// retorna dados da sessão
function getSessionData(key){
	var data = new Object();
	for(var i in key)
		data[i] = key[i];
	
	return $.ajax({
		url:'inc/controle/atendimento.php?acao=getSessionData',
		data:data,
		type:'POST',
		dataType: 'json'
	});
}

//remove msg da sessão
function removeMsg(){
	$.ajax({
		url:'inc/controle/atendimento.php?acao=deleteSessionMsg',
	});
}