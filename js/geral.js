$(document).ready(function(){
	// carrega mensagem pendente ao usuário
	var userData = getSessionData(["msg","tipo"]);
	userData.done(function (data) {
		if(data.value.msg != null && data.value.msg != '')
			showToastr(data.value.tipo, data.value.msg);
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