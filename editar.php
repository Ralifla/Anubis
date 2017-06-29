<?php include "header.php"; ?>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-user" aria-hidden="true"></i>
			<h2>Editar</h2>
		</div>
		<div class="portlet-body">
			<form id="editar-vendedor">
			</form>
			<div class="text-center">
				<button id="salvar" class="btn btn-primary">Salvar</button>
			</div>
		</div>
	</div>
</div>
<script>
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
</script>
<?php include "footer.php"; ?>