<?php include "header.php"; ?>
<link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-users" aria-hidden="true"></i>
			<h2>Listagem</h2>
		</div>
		<div class="portlet-body">
			<div>
				<table id="listagem-vendedor" class="table">
					<thead>
						<tr>
							<?php 
								$thead;$tipo = $_GET['tipo'];
								if(strcmp($tipo, "vendedor") == 0){
									$thead = "<th>Id</th><th>CPF</th><th>Nome</th><th>E-mail</th><th>Detalhes</th>";
								}else if(strcmp($tipo, "webmaster") == 0){
									$thead = "<th>Id</th><th>Login</th><th>Nome</th><th>Permissão</th><th>Detalhes</th>";
								}
								echo $thead
							?>
						</tr>
					</thead>
					<tbody></tbody>			
				</table>
				<div id="pagination" class="col-xs-12 pull-right"></div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	// pesquisa
	var get = document.URL;
	get = get.split("?");
	get = get[1].split(/=|&/);
	
	// datatable
	var datatable = $('#listagem-vendedor').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": {
            "url": "inc/controle/Atendimento.php?acao=listar",
            "type": "POST",
            "data": function ( d ) {
                d.listagem = get[1],
             	d.search_aux = get[3];
            }
        },
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "columns": [
            { "data": "0" },
            { "data": "1" },
            { "data": "2" },
            { "data": "3" },
            {
                sortable: false,
                className: 'text-center',
                "render": function ( data, type, full, meta ) {
                    var url = 'editar.php?tipo='+get[1]+'&id='+full[0];
                    return '<a href='+url+'><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }
            },
        ]
    });

    $(".portlet-body input[type='search']").val(get[3]);
    get[3] = "";
    
});
</script>
<?php include "footer.php"; ?>