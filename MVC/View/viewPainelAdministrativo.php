<?php
	//PÁGINA INICIAL DO SISTEMA. DEPOIS DO LOGIN VEM PRA CA 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");

	$nomeCliente = $_SESSION['nome-cliente'];
?>

<!-- DEPENDENDO DO TIPO DO USUARIO, SERÁ DIFERENTE 
	A VISÃO DESSA PÁGINA-->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">

		<ul>		
			<li>Clientes</li>
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
	<section class="nav-painel">
		
		<!-- 

		AQUI VÃO ENTRAR OS BLOCOS PARA O CLIENTE VER AS OPÇÕES QUE ELE TEM 
		PARA USAR O SISTEMA

		POR ENQUANTO SERÃO 3 BLOCOS:

		*FAZER SOLICITAÇÃO (request)

		*ACOMPANHAR SOLICITAÇÕES (VAI LEVAR PARA UMA PLANILHA) (clock)
		
		*VER CALENDÁRIOS (calendar)

		-->

		<!--<ul>		
			<li><a href="">Seus calendários</a></li>
		</ul>-->

	</section>

	<section class="opcoes-clientes-wrapper separador">
		<a href="viewCalendariosPorCliente.php">
			<div class="opcoes-clientes-box" style="background-color: #FCD459;">
				<img src="../../images/calendarW.png">
				<h2>VER CALENDÁRIOS</h2>
			</div>
		</a>

		<a onclick="cadastroSolicitacao()">
			<div class="opcoes-clientes-box" style="background-color: #5ADC79;">
				<img src="../../images/helpW.png">
				<h2>FAZER UMA SOLICITAÇÃO</h2>
			</div>
		</a>

		<a href="viewSolicitacoesPorCliente.php?cliente=<?php echo "$nomeCliente"?>">
			<div class="opcoes-clientes-box" style="background-color: #63B9F4;">
				<img src="../../images/fileW.png">
				<h2>ACOMPANHAR SOLICITAÇÕES</h2>
			</div>
		</a>




	<!--<section class="clientes-box-wrapper separador">
		<h2>teste</h2>
		<?php 
			/*include_once("../Model/modelCalendarios.php");

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

		<?php } }*/?>--><!-- FIM DO FOR CLIENTES-BOX -->

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<!-- JANELA PARA CADASTRO DE UMA SOLICITAÇÃO PELO CLIENTE -->
	<div class="janela-modal-cadastro">
		<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
		<div class="header-janela-modal">
			<h2>Cadastrar solicitação:</h2>
		</div>

		<div class="info-cadastro-cliente">
			<form method="POST" action="../Model/modelCadastroSolicitacao.php" enctype="multipart/form-data">

				<div class="form-box-cliente">
					
					<label>Título:</label><br>
					<input type="text" placeholder="Título" name="titulo-solicitacao" style="text-align: center; width: 200px"><br>					

					<label>Tipo:</label><br><br>

					<div class="opcoes-solicitacao-cliente">
						<input type="radio" value="web" name="tipo-solicitacao" required>WEB
						<input type="radio" value="midiasocial" name="tipo-solicitacao" required>Midia Social
						<input type="radio" value="outdoor" name="tipo-solicitacao" required>Outdoor
						<input type="radio" value="folder" name="tipo-solicitacao" required>Folder
						<input type="radio" value="outro" name="tipo-solicitacao" required>Outro
					</div>

					<label>Descrição:</label><br><br>
					<textarea name="descricao-solicitacao"></textarea>
					<br><br>
					<label>Informe o prazo:</label><br>
					<input type="date" name="prazo-solicitacao">
				</div>

				<br>

				<div class="anexar-foto">
					<input type="checkbox" name="anexar-foto" value="1" onclick="enviarFoto()"> ANEXAR FOTO?
					<br>
					<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
				</div>				
				
				<button>CONFIRMAR</button>
			</form>
		</div>
	</div>


<?php }?>

<script type="text/javascript">
		
	function cadastroSolicitacao(){
		$('.janela-modal-cadastro').css('display', 'block');
		$('body').css('background-color', 'rgba(0,0,0,0.5)');
		$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
	}


	function fecharJanelaModal(){
		$('.janela-modal-cadastro').css('display', 'none');	
		$('body').css('background-color', '#F5F5F5');
		$('tr:nth-child(2n)').css('background-color', 'white');
	}

	function confirmarExcluir(idCalendario){
		var idCalendario = idCalendario;
        var doc; 
        var result = confirm("Confirmar exclusão do calendário?"); 

        if (result == true) { 
            doc = "../Model/modelExcluirCalendario.php?id="+idCalendario; 
        } else { 
            doc = "viewCalendarios.php"; 
        } 

        window.location.replace(doc);
	}

	function enviarFoto(){
		$('#fileToUpload').toggle( "slow", function(){});
	}
</script>

<?php 
	include_once("../View/viewFooter.php");	
?>