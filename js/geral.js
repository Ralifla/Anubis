$(document).ready(function(){
	// carrega mensagem pendente ao usuário
	var userData = getSessionData(["descricao","tipo"]);
	userData.done(function (data) {
		if(data.value.descricao != null)
			showToastr(data.value.tipo, data.value.descricao, true);
	});
	
	// abre/fecha campo de pesquisa
	$(document).on("click", function(event){
		if($(event.target).parents("#container-search").length){
			$(".content-search").addClass("active");
			$(".search-box").trigger("focus");
		}else{
			$(".content-search").removeClass("active");
			$(".search-box").val('');
		}
	});
	
	//menu collapse
	$("body").on("click",".collapse-item > a",function(event){
		event.preventDefault();
		$(this).parent().toggleClass("open");
	});
	
	removeLoading();
});

// Escreve mensagem toastr
function showToastr(tipo, msg, ajax_remove) {
	Command: toastr[tipo](msg);
	toastr.options = {
			"debug" : false,
			"positionClass" : "toast-top-center",
			"onclick" : null,
			"fadeIn" : 300,
			"fadeOut" : 1000,
			"timeOut" : 5000,
			"extendedTimeOut" : 1000
	}
	if(ajax_remove)
		removeMsg();
}

// gera grid bootstrap
function get_auto_grid(last_style, length, key){
	if(last_style){
		last_style = last_style.split(/[\s,]+|-/);
	}
	var container_class = "col-lg-4 col-md-6 col-xs-12";
	return container_class;
}

// retorna primeira letra da string maiuscula
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// campos select
function apllySelectInputs(obj){
	var select = {
			'vendedor_sexo' : ['FEMININO','MASCULINO'],
			'vendedor_residencia' : ['PROPRIA','ALUGADA','CEDIDA','PARENTES'],
			'vendedor_estado_civil' : ['SOLTEIRA','CASADA','DIVORCIADA','VIUVA','AMASIADA']
	}
	for(var i=0; i<obj.length; i++){
		for(var key in select){
			if(key == obj[i].id){
				var	html = '<select>';
					var option = select[key];
					for(var j in option){
						if(obj[i].value.trim() == option[j])
							html += '<option selected="selected" value="'+option[j]+'">'+option[j]+'</option>';
						else
							html += '<option value="'+option[j]+'">'+option[j]+'</option>';
					}
					html += '</select>';
				$(obj[i]).parent("div").append(html);
				$(obj[i]).remove();
				break;
			}
		}
	}
}

function placeLoading(){
	$("body").addClass("status-loading");
}

function removeLoading(){
	$("body").removeClass("status-loading");
}