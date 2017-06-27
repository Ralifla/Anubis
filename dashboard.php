<?php include "header.php"; ?>
<div class="col-md-9 col-lg-10">
	<div class="portlet">
		<div class="portlet-title">
			<i class="fa fa-bar-chart" aria-hidden="true"></i>
			<h2>Dashboard</h2>
		</div>
		<div class="portlet-body">
			<div class="row">
				<div id="dashboard-kits" class="col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-card font-blue-madison">
						<div class="number col-xs-9">
							<h3>10</h3>
							<small>Kits montados</small>
						</div>
						<div class="icon text-right col-xs-3">
							<i class="fa fa-3x fa-shopping-basket" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div id="dashboard-vendedores" class="col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-card font-green-meadow">
						<div class="number col-xs-9">
							<h3>10</h3>
							<small>Vendedores Cadastrados</small>
						</div>
						<div class="icon text-right col-xs-3">
							<i class="fa fa-3x fa-user-plus" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div id="dashboard-aguardando" class="col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-card font-red-soft">
						<div class="number col-xs-9">
							<h3>10</h3>
							<small>Aguardando Aprovação</small>
						</div>
						<div class="icon text-right col-xs-3">
							<i class="fa fa-3x fa-handshake-o" aria-hidden="true"></i>
						</div>
					</div>
				</div>
				<div id="dashboard-users" class="col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-card font-purple">
						<div class="number col-xs-9">
							<h3>10</h3>
							<small>Administradores Operando</small>
						</div>
						<div class="icon text-right col-xs-3">
							<i class="fa fa-3x fa-flag" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
<script>
$.ajax({
	url: "inc/controle/UserAtendimento.php?acao=dashboardData",
	type:"POST",
	dataType:"json",
	success:function(data){
		var qtd = 50;
		$({countNum: 0}).animate({
				qtd_padrao: 50,
				qtd_adm: parseInt(data.users),
				qtd_vendedor: parseInt(data.vendedores)+(1)
			},{
			duration: 3000,
			easing:'linear',
			step: function() {
				$("#dashboard-users h3").html(Math.floor(this.qtd_adm));
				$("#dashboard-kits h3").html(Math.floor(this.qtd_padrao));
				$("#dashboard-aguardando h3").html(Math.floor(this.qtd_padrao));
				$("#dashboard-vendedores h3").html(Math.floor(this.qtd_vendedor));
			}
		});
	}
});
</script>
<?php include "footer.php"; ?>