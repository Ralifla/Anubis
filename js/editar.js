$(document).ready(function(){
	var id = document.URL;
	id = id.split("?");
	id = id[1].split(/=|&/);
	// cria inputs baseado nos keys/values da tabela de vendedores
	$.ajax({
		url: "inc/controle/VendedorAtendimento.php?acao=getVendedor",
		type: 'POST',
		dataType: 'json',
		data: {'id':id[3]},
		success: function(data){
			/*
			for(var i in data){
				var name = data[i][0];
				var label = name.replace("vendedor_", "");
				label = label.replace("_", " ");
				label = label.length > 3 ? capitalizeFirstLetter(label) : label.toUpperCase();	
				
				var html = get_edit_structure(label, name, data[i][1]);
				$("#editar-vendedor").append(html);
			}
			apllySelectInputs($("#editar-vendedor input"));
			removeLoading();
			*/
		}
	});
	
	// abre modal de documentos
	$("#open-modal").on("click", function(){
		$("#modal-documentos").modal("show");
	});

	// envido de documentos
	var isAdvancedUpload = function() {
		  var div = document.createElement('div');
		  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
	}();
	if (isAdvancedUpload) {
		  var droppedFiles = false;
		  $("#drop-area").on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
		    e.preventDefault();
		    e.stopPropagation();
		  })
		  .on('dragover dragenter', function() {
			  $("#drop-area").addClass('is-dragover');
		  })
		  .on('dragleave dragend drop', function() {
			  $("#drop-area").removeClass('is-dragover');
		  })
		  .on('drop', function(e) {
			  var data = new FormData();
			  droppedFiles = e.originalEvent.dataTransfer.files;
			  
			  var data = new FormData();
			  $.each(droppedFiles, function(i, file) {
				  data.append('file[]', file);
			  });
			  data.append("cpf", "11212901916");
			  
			  // salva arquivos 
			  $.ajax({
					url: 'inc/controle/VendedorAtendimento.php?acao=saveFiles',
					data: data,	
				    type: 'POST',
				    contentType: false,
				    processData: false,
					success: function(data){
						console.log(data);
					}
			  });
		  });

	}
});

// retorna estrutura do input
function get_edit_structure(label, key, value){
	var last_style = $("#editar-vendedor div:last-child").attr("class");
	var container_class = get_auto_grid(last_style, value.length, key);
	
	var html = '<div class="'+container_class+'">';
			html += '<label for="'+key+'">'+label+'</label>';
			html += '<input type="text" id="'+key+'" value="'+value+' ">';
		html += '</div>';
	return html;
}