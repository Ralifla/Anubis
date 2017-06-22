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