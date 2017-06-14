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
}