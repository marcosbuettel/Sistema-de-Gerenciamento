<?php 
	//PÁGINA PARA VISUALIZAR O ANDAMENTO DOS PROJETOS	
	
	$tipoFluxo = $_GET['tipo'];

	include_once("../View/viewHead.php");
	include('../Controller/controllerFormatarData.php');
	include('../Controller/controllerTarefaAtrasada.php');
	include_once("../Model/modelBancoDeDados.php");	

	/* 
		TIPOS PASSADOS PELO LINK:
		0 -> IDENTIDADE VISUAL
		1 -> MARKETING ORGÂNICO
		2 -> MARKETING PERFORMANCE
		3 -> ECOMMERCE
		4 -> INSTITUCIONAL			
	*/	

	if($tipoFluxo == 0){
		$buscarProjetos = $pdo->prepare("SELECT * FROM projetos WHERE tipo_projeto = 'id-visual'");
	}else if($tipoFluxo == 1){
		$buscarProjetos = $pdo->prepare("SELECT * FROM projetos WHERE tipo_projeto = 'mkt-org'");
	}else if($tipoFluxo == 2){
		$buscarProjetos = $pdo->prepare("SELECT * FROM projetos WHERE tipo_projeto = 'mkt-per'");
	}else if($tipoFluxo == 3){
		$buscarProjetos = $pdo->prepare("SELECT * FROM projetos WHERE tipo_projeto = 'ecommerce'");
	}else if($tipoFluxo == 4){
		$buscarProjetos = $pdo->prepare("SELECT * FROM projetos WHERE tipo_projeto = 'institucional'");
	}

	$buscarProjetos->execute();
	$totalProjetos = $buscarProjetos->fetchAll();
?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA
		OS USUARIOS TIPO 'LEITOR' TEM
		SUA PRÓPRIA PÁGINA SEPARADA PARA 
		VER SEUS PROJETOS -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	<!-- TROCAR ESSE IF PELO DO USUARIO LOGADO OU MARCADO NO PROJETO -->
	<section class="nav-painel separador">
		
		<ul>		
			<li>Andamento dos projetos</li>
		</ul>

	</section>

	<section class="calendario-box-wrapper separador tabela-box-wrapper">

		<br>

		<div class="fluxo-wrapper">
			
			<?php 
				function blocoColunaFluxo($nomeProjeto, $fluxoEscolhido, $idProjeto, $tipoFluxo){
			?>
			<div class="bloco-coluna-fluxo">
				<h2><?php echo $nomeProjeto?></h2>
				<i class="fa-solid fa-ellipsis" onclick="mostrarOpcoes(<?php echo $idProjeto ?>)"></i>

				<div class="opcoes-coluna" id="opcoes<?php echo $idProjeto ?>">
					<?php for($k = 0; $k < count($fluxoEscolhido); $k++){?>
						<p onclick="mudarColuna(<?php echo $k ?>, <?php echo $idProjeto ?>, <?php echo $tipoFluxo?>)"><?php echo $fluxoEscolhido[$k]?></p>
					<?php }?>
				</div>
			</div>
			<?php } ?>

			<?php 
				$fluxoIdentidade = array('Briefing', 'Brainstorming', 'Criação', 'Apresentação', 'Alteração', 'Enviar Arquivos', 'Gráfica', 'Concluído');

				$fluxoOrganico = array('Briefing', 'Planejamento', 'Criação de conteúdo', 'Design', 'Aprovação', 'Publicação', 'Concluído');

				$fluxoPerformance = array('Briefing', 'Planejamento', 'Estratégia', 'Copy', 'Design', 'Landing Page', 'Verba', 'Subir a campanha', 'Relatório', 'Concluído');

				$fluxoEcommerce = array('B1 - Entrada Cliente', 'B2 - Briefing Cliente', 'Registro de Domínio', 'Apontamento de DNS', 'Configurações Iniciais', 'Construção de Layout', 'Criação de Banners', 'Apresentação para o cliente', 'Treinamento', 'Concluído');

				$fluxoInstitucional = array('B1 - Entrada Cliente', 'B2 - Briefing Cliente', 'Registro de Domínio', 'Apontamento de DNS', 'Configurações Iniciais', 'Construção de Layout', 'Criação de Banners', 'Apresentação para o cliente', 'Treinamento', 'Concluído');

				if($tipoFluxo == 0){
					$fluxoEscolhido = $fluxoIdentidade;	
				}else if($tipoFluxo == 1){
					$fluxoEscolhido = $fluxoOrganico;
				}else if($tipoFluxo == 2){
					$fluxoEscolhido = $fluxoPerformance;
				}else if($tipoFluxo == 3){
					$fluxoEscolhido = $fluxoEcommerce;
				}else{
					$fluxoEscolhido = $fluxoInstitucional;
				}				

				for($i = 0; $i < count($fluxoEscolhido); $i++){					
				
			?>	

			<div class="coluna-fluxo">
				<h2><?php echo $fluxoEscolhido[$i] ?></h2>				

				<?php 
					for($j = 0; $j < count($totalProjetos); $j++){						
				?>
				<!-- 
					TIPOS PASSADOS PELO LINK:
					0 -> IDENTIDADE VISUAL
					1 -> MARKETING ORGÂNICO
					2 -> MARKETING PERFORMANCE
					3 -> ECOMMERCE
					4 -> INSTITUCIONAL			
				-->

					<!-- IDENTIDADE VISUAL -->
					<?php if($tipoFluxo == 0){?>

						<?php if($totalProjetos[$j]['status_projeto'] == 'solicitado' && $i == 0){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'brainstorming' && $i == 1){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'criacao' && $i == 2){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'apresentacao' && $i == 3){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'alteracao' && $i == 4){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'enviar-arquivos' && $i == 5){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'grafica' && $i == 6){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'concluido' && $i == 7){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>					

						<?php }?>

					<?php }?>


					<!-- MARKETING ORGÂNICO -->
					<?php if($tipoFluxo == 1){?>

						<?php if($totalProjetos[$j]['status_projeto'] == 'solicitado' && $i == 0){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'planejamento' && $i == 1){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'criacao-conteudo' && $i == 2){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'design' && $i == 3){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'aprovacao' && $i == 4){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'publicacao' && $i == 5){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'concluido' && $i == 6){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>						

						<?php }?>

					<?php }?>


					<!-- MARKETING PERFORMANCE -->
					<?php if($tipoFluxo == 2){?>

						<?php if($totalProjetos[$j]['status_projeto'] == 'solicitado' && $i == 0){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'planejamento' && $i == 1){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'estrategia' && $i == 2){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'copy' && $i == 3){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'design' && $i == 4){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'landing-page' && $i == 5){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'verba' && $i == 6){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'subir-campanha' && $i == 7){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'relatorio' && $i == 8){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'concluido' && $i == 8){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }?>

					<?php }?>


					<!-- ECOMMERCE -->
					<?php if($tipoFluxo == 3){?>

						<?php if($totalProjetos[$j]['status_projeto'] == 'solicitado' && $i == 0){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'b2' && $i == 1){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'registro-dominio' && $i == 2){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'dns' && $i == 3){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'config-iniciais' && $i == 4){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'layout' && $i == 5){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'banners' && $i == 6){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'ap-cliente' && $i == 7){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'treinamento' && $i == 8){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'concluido' && $i == 9){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }?>

					<?php }?>

					<!-- INSTITUCIONAL -->
					<?php if($tipoFluxo == 4){?>

						<?php if($totalProjetos[$j]['status_projeto'] == 'solicitado' && $i == 0){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'b2' && $i == 1){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'registro-dominio' && $i == 2){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'dns' && $i == 3){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'config-iniciais' && $i == 4){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'layout' && $i == 5){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'banners' && $i == 6){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'ap-cliente' && $i == 7){ ?>	

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'treinamento' && $i == 8){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }else if($totalProjetos[$j]['status_projeto'] == 'concluido' && $i == 9){ ?>

							<?php blocoColunaFluxo($totalProjetos[$j]['nome_projeto'], $fluxoEscolhido, $totalProjetos[$j]['id_projeto'], $tipoFluxo)?>

						<?php }?>

					<?php }?>

				<?php }?>
			</div>

			<?php }?>


			

		</div>

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
			
		function mostrarOpcoes(idProjeto){
			$('#opcoes'+idProjeto).slideToggle();
		}

		$('.opcoes-coluna').mouseleave( function(){
			$('.opcoes-coluna').css('display', 'none');
		});

		function mudarColuna(coluna, idProjeto, tipoFluxo){
			document.location = '../Model/modelMudarStatusProjeto.php?idP='+idProjeto+'&coluna='+coluna+'&tipo='+tipoFluxo;
		}
		

	</script>

<?php }else{?>
	<!-- CASO O USUARIO LOGADO NÃO SEJA 'ADM' OU 'MASTER'
		E TAMBÉM NÃO SEJA O CLIENTE QUE ESTEJA LIGADO
		A ESSE CALENDARIO, ELE VERÁ ESSA MENSAGEM NA TELA -->
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>