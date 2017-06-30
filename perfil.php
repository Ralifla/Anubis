<?php include "header.php"; ?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-address-card-o" aria-hidden="true"></i>
			<h2>Configurações da conta</h2>
		</div>
		<div class="portlet-body">
			<div>
				<ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" href="#menu1">Informações Pessoais</a></li>
				    <li><a data-toggle="tab" href="#menu2">Alterar Senha</a></li>
				</ul>
			</div>
			<div class="tab-content">
			    <div id="menu1" class="tab-pane fade in active">
					<form id="edit-perfil">
						<div id="salvar-perfil" class="col-xs-12 text-center">
							<button class="btn btn-primary">Salvar</button>
						</div>
					</form>
			    </div>
			    <div id="menu2" class="tab-pane fade">
			    	<form id="edit-password">
			    		<div class="col-xs-12">
			    			<label for="user_nome">Senha Anterior</label>
			    			<input type="password" name="user_old_pass">
		    			</div>
			    		<div class="col-md-6 col-xs-12">
			    			<label for="user_nome">Nova Senha</label>
			    			<input type="password" name="user_new_pass_1">
		    			</div>
			    		<div class="col-md-6 col-xs-12">
			    			<label for="user_nome">Re-escreva a Nova Senha</label>
			    			<input type="password" name="user_new_pass_2">
		    			</div>
			    		<div id="salvar-senha" class="col-xs-12 text-center">
							<button class="btn btn-primary">Salvar</button>
						</div>
			    	</form>
			    </div>
		    </div>
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
		data: {'id':id},
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

	// alteração de senha
	$("#salvar-senha button").on("click",function(){
		event.preventDefault();
		var velha = $("input[name='user_old_pass']").val();
		var nova = $("input[name='user_new_pass_1']").val();
		var nova2 = $("input[name='user_new_pass_2']").val();

		if(nova == "" || velha == ""){
			var tipo = "warning";
			var descricao = "Todos os campos devem ser preenchidos!";
			showToastr(tipo,descricao,false);
		}else if(nova != nova2){
			var tipo = "warning";
			var descricao = "As senhas não conferem!";
			showToastr(tipo,descricao,false);
		}else{
			var data = {
				"new" : nova,
				"old" : velha,
				"id"  : <?php echo $_SESSION['user_id']."\n"?>
			}

			$.ajax({
				url: "inc/controle/UserAtendimento.php?acao=updatePassword",
				type:"POST",
				data: data,
				dataType:"json",
				success:function(data){
					// exibe mensagem retornada da requisição
					showToastr(data.tipo, data.descricao, false);
				}
			});
		}
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