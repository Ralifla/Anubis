<?php include "header.php"; ?>
<link rel="stylesheet" type="text/css" href="css/editar.css"></link>
<script type="text/javascript" src="js/editar.js"></script>
<div class="col-md-9 col-lg-10 col-xs-12">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-user" aria-hidden="true"></i>
			<h2>Editar</h2>
		</div>
		<div class="portlet-body">
			<form id="editar-vendedor">
			
				<div class="container col-xs-12">
			    	<h3 data-toggle="collapse" data-target="#documentos" class="collapse-title">Documentos</h3>
				  	<div id="documentos" class="collapse in">
				  		<div id="drop-area" class="box clearfix">
					    	<i id="open-modal" class="fa fa-4x fa-folder-open-o" aria-hidden="true"></i>
				  		</div>
				  		<!-- Modal Documentos -->
						<div id="modal-documentos" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Documentos Enviados</h4>
									</div>
									<div class="modal-body">
										<p class="text-center">Nenhum arquivo foi enviado...</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default"
											data-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>
						<!-- Fim Modal -->
					</div>
				</div>
			</form>
			<div class="text-center">
				<button id="salvar" class="btn btn-primary">Salvar</button>
			</div>
		</div>
	</div>
</div>
<?php include "footer.php"; ?>