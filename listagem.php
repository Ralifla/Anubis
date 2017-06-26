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
							<th>Id</th>
							<th>CPF</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Detalhes</th>
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
	var serach_key = document.URL;
	serach_key = serach_key.split("=");
	// datatable
	var datatable = $('#listagem-vendedor').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": {
            "url": "inc/controle/VendedorAtendimento.php?acao=listar",
            "type": "POST",
            "data": function ( d ) {
            	d.search_aux = serach_key[1];
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
            { "data": "id" },
            { "data": "cpf" },
            { "data": "nome" },
            { "data": "email" },
            {
                sortable: false,
                className: 'text-center',
                "render": function ( data, type, full, meta ) {
                    var url = 'editar.php?id='+full.id;
                    return '<a href='+url+'><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }
            },
        ]
    });
	$(".portlet-body input[type='search']").val(serach_key[1]);
	serach_key[1] = '';
});
</script>
<?php include "footer.php"; ?>