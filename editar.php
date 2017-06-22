<?php include "header.php"; ?>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-user" aria-hidden="true"></i>
			<h2>Editar</h2>
		</div>
		<div class="portlet-body">
			<form id="editar-vendedor"></form>
			<div class="text-center">
				<button id="salvar" class="btn btn-primary">Salvar</button>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	var id = document.URL;
	id = id.split("=");
	$.ajax({
		url: "inc/controle/VendedorAtendimento.php?acao=getVendedor",
		type: 'POST',
		dataType: 'json',
		data: {'id':id[1]},
		success: function(data){
			for(var i in data){
				var html = get_edit_structure(i, data[i]);
				$("#editar-vendedor").append(html);
			}
		}
			
	});
});

function get_edit_structure(key, value){
	var container_class = get_auto_grid(value.length, key);
	
	var html = '<div class="form-group '+container_class+'">';
			html += '<label for="'+key+'">'+key+'</label>';
			html += '<input type="text" class="form-control" id="'+key+'" value="'+value+' ">';
		html += '</div>';
	return html;
}
</script>
<?php include "footer.php"; ?>