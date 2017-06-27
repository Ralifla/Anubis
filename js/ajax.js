$(document).ready(function(){
	// monta menu via ajax
	$.ajax({
		url: 'inc/controle/UserAtendimento.php?acao=build_menu',
		type: 'POST',
		dataType: 'json',
		success: function(data){
			// montagem do html
			var lastAppend = 0;
			for(var i in data){
				if(data[i].parent == 0){
					// item pai
					var html = "";
					html += buildLI(data[i]);
					$("#container-menu").append(html);
				}else{
					// item filho
					if( i > lastAppend){
						var html = "";
						lastAppend = i;
						html += '<ul class="sub-menu">';
						var subitem = true;
						do{
							if(data[lastAppend].parent == 0)
								subitem = false;
							else
								html += buildLI(data[lastAppend]);
							
						}while(subitem && ++lastAppend < data.length);
						html += '</ul>';
						$("#container-menu > li:last-child").append(html);
					}
				}
			}
			//controle de links do menu
			menuLink();
		}
	});
	
	// loggout do sistema
	$("#logout").on("click",function(){
		$.ajax({
			url: 'inc/controle/UserAtendimento.php?acao=logout',
			beforeSend:function(){
				window.location.replace("/anubis");
			}
		});
	});
	
});

// controle de links do menu
function menuLink(){
	var elem = $("#container-menu > li");
	for(var i=0; i<elem.length; i++){
		var link = $(elem[i]).find("a").attr("href");
		if(!link)
			$(elem[i]).addClass("collapse-item");
	}
}

// controi estrutura de item de menu
function buildLI(data){
	var html = "";
	html += '<li class="nav-item">';
	html += '<a href="'+data.link+'" class="nav-link">';
	if(data.icon)
		html += '<i class="fa '+data.icon+'"></i>';	
	html += '<span class="title">'+data.nome+'</span>';
	html += '</a>';
	html += '</li>';
	return html;
}

// retorna dados da sessão
function getSessionData(key){
	var data = new Object();
	for(var i in key)
		data[i] = key[i];
	
	return $.ajax({
		url:'inc/controle/Atendimento.php?acao=getSessionData',
		data:data,
		type:'POST',
		dataType: 'json'
	});
}

//remove msg da sessão
function removeMsg(){
	$.ajax({
		url:'inc/controle/Atendimento.php?acao=deleteSessionMsg',
	});
}