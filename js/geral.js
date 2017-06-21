$(document).ready(function(){
	// carrega mensagem pendente ao usuário
	var userData = getSessionData(["msg","tipo"]);
	userData.done(function (data) {
		if(data.value.msg != null && data.value.msg != '')
			showToastr(data.value.tipo, data.value.msg);
	});
	
	// abre/fecha campo de pesquisa
	$("#open-search").on("click",function(){
		$(this).parents(".content-search").addClass("active");
		$(".search-box").trigger("focus");
	});
	$(".content-search").focusout(function(){
		$(this).removeClass("active");
		$(".search-box").val('');
	});
	
	//menu collapse
	$("body").on("click",".collapse-item > a",function(){
		event.preventDefault();
		$(this).parent().toggleClass("open");
	});
	
});

// Escreve mensagem toastr
function showToastr(tipo, msg) {
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
	
	removeMsg();
}