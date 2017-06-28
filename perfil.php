<?php include "header.php"; ?>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-address-card-o" aria-hidden="true"></i>
			<h2>Configurações da conta</h2>
		</div>
		<div class="portlet-body">
			<form id="edit-perfil">
				<div id="salvar-perfil" class="col-xs-12 text-center">
					<button class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>	
<script>
$(document).ready(function(){
	var id = <?php echo $_SESSION['user_id'].";\n"?>

	// cria inputs baseado nos keys/values
	$.ajax({
		url: "inc/controle/UserAtendimento.php?acao=getUser",
		type: 'POST',
		dataType: 'json',
		data: {'id':id[1]},
		success: function(data){
			var obj = $("#edit-perfil");
			for(var i in data){
				var html_data = {
						'name'  : data[i]["meta_key"],
						'title' : data[i]["meta_key"].replace("user_", ""),
						'value' : data[i]["meta_value"].replace("user_", "")
				}
				var html = get_edit_structure(html_data);
				$(obj).find("#salvar-perfil").before(html);
			}
		}
	});

	// salva alterações do form perfil
	$("#salvar-perfil button").on("click",function(){
		event.preventDefault();
		var form = $('#edit-perfil')[0];
		var formData = new FormData(form);
		formData.append( 'id', <?php echo $_SESSION['user_id'];?>);
		
		$.ajax({
			url: "inc/controle/UserAtendimento.php?acao=updateUser",
			type:"POST",
			data: formData,
			processData: false,
		  	contentType: false,
			dataType:"json",
			success:function(data){
				// exibe mensagem retornada da requisição
				showToastr(data.tipo, data.descricao, false);
			}
		});
	});
});

// retorna estrutura do input
function get_edit_structure(html_data){
	var html = '<div class="col-md-6 col-xs-12">';
			html += '<label for="'+html_data["name"]+'">'+html_data["title"]+'</label>';
			html += '<input type="text" name="'+html_data["name"]+'" value="'+html_data["value"]+' ">';
		html += '</div>';
	return html;
}
</script>	
<?php include "footer.php"; ?>