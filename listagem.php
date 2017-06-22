<?php include "header.php"; ?>
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
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>