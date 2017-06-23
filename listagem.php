<?php include "header.php"; ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-users" aria-hidden="true"></i>
			<h2>Listagem</h2>
		</div>
		<div class="portlet-body">
			<div>
				<div class="col-lg-2 col-md-3 col-xs-6 pull-right">
					<label for="quantidade">Quantidade:</label>
					<select name="quantidade">
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
				</div>
				<table id="listagem-vendedor" class="table">
					<thead>
						<tr>
							<th>Id</th>
							<th>CPF</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th class="text-center">Editar</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					session_start();
					$lista = $_SESSION['lista'];
					if(count($lista) > 0){
						foreach($lista as $key => $value){
							?>
							<tr>
								<td><?php echo $value['id']?></td>
								<td><?php echo $value['cpf']?></td>
								<td><?php echo $value['nome']?></td>
								<td><?php echo $value['email']?></td>
								<td class="text-center"><a href="editar.php?id=<?php echo $value['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
							</tr>
							<?php 
						}
					}else{
						?>
						<tr><td class="text-center" colspan="5">Não foram encontrados resultados</td></tr>
						<?php 
					}
					?>
					</tbody>			
				</table>
				<div id="pagination" class="col-xs-12 pull-right"></div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/server_processing.php"
    } );
});
</script>
<?php include "footer.php"; ?>