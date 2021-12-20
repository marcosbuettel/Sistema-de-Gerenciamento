<?php 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">

		<ul>		
			<li><a href="">Clientes</a></li>
		</ul>

	</section>

	<section class="clientes-box-wrapper separador">
		
		<?php 
			include_once("../Model/modelClientes.php");
			for ($i=0; $i < count($totalClientes) ; $i++) { 
		?>

		<div class="clientes-box">
			
			<h2><?php echo $totalClientes[$i]['nome_cliente']?></h2><br>

			<?php 
				$idCliente = $totalClientes[$i]['id_cliente'];
				include("../Model/modelClienteCalendario.php");
			?>

			<div class="info-clientes-calendarios">
				<p>Calendários: <?php echo count($totalClienteCalendario)?></p>
			</div>
		</div>

		<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

<?php }else{?>
	<section class="nav-painel separador">

		<ul>		
			<li><a href="">Seus calendários</a></li>
		</ul>

	</section>

	<section class="clientes-box-wrapper separador">
		
		<?php 
			include_once("../Model/modelCalendarios.php");

			for ($i=0; $i < count($totalCalendarios) ; $i++){
				$idCalendario = $totalCalendarios[$i]['id_calendario'];
		?>

		<?php 
			$idCliente = $totalCalendarios[$i]['id_cliente'];
			include("../Model/modelCalendarioCliente.php");

			if($_SESSION['nome-cliente'] == $totalCalendarioCliente[0]['nome_cliente']){
		?>

		<a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>">
			<div class="clientes-box">
				
				<h2><?php echo $totalCalendarios[$i]['mes_calendario']?></h2><br>

				<div class="info-clientes-calendarios">
					<p>Semanas: <?php echo $totalCalendarios[$i]['qtd_semanas_calendario']?></p>
				</div>
			</div>
		</a>

		<?php } }?><!-- FIM DO FOR CLIENTES-BOX -->

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->
<?php }?>

<?php 
	include_once("../View/viewFooter.php");	
?>