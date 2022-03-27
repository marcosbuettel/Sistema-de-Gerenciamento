<?php 
	//PÁGINA PARA VISUALIZAR AS TAREFAS REFERENTE AOS BLOCOS 
	//CADASTRADOS EM CADA CALENDÁRIO
	
	//include_once("MVC/Controller/controllerAcesso.php");
	include_once('../Controller/controllerTarefaAtrasada.php');
	include_once('../Controller/controllerVerificarP.php');
	include_once('../Controller/controllerFormatarData.php');
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelAgendamentos.php");
?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Agenda</li>
			<div class="lista-nav-painel">
				<li><a href="#" onclick="cadastroSolicitacao()">ADICIONAR AGENDAMENTO</a></li>
			</div>
		</ul>

	</section>

	<section class="separador quadro-de-tarefas">
		
		<div class="tarefas-a-fazer">
			<div class="header-tarefas-a-fazer">
				<h2>A MARCAR</h2>
			</div>

			<div class="tarefas-a-fazer-box-wrapper">

				<?php for($i = 0; $i < count($totalAgendamentos); $i++){ ?>

				<?php if($totalAgendamentos[$i]['status_agendamento'] == 'aguardando'){ ?>

				<div class="tarefas-a-fazer-box">	
					
					<h2 style="margin-bottom: 10px"><?php echo $totalAgendamentos[$i]['cliente_agendamento'] ?></h2>

					<h4><?php echo $totalAgendamentos[$i]['titulo_agendamento'] ?></h4>

					<?php 
						$dataHora = explode(' ', $totalAgendamentos[$i]['data_agendamento']);

						$dataFormatada = explode('-', $dataHora[0]);
					?>

					<p style="font-size: 12px">Data: <?php echo $dataFormatada[2]. '/' .$dataFormatada[1]. '/' .$dataFormatada[0]. ' <br>Horário: ' .$dataHora[1] ?></p>

					<form class="editar-agendamento" id="editar-agendamento<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>" action="../Model/modelEditarAgendamento.php?id=<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>" method="POST">
						<input style="width: 100%; margin-top: 5px" type="datetime-local" name="dataHoraAgendamento">
						<button style="cursor: pointer;background-color: black; color: white; font-size: 14px; border: none; padding: 2px 5px; margin-top: 5px">EDITAR</button>
					</form>

					<?php if($totalAgendamentos[$i]['tipo_agendamento'] == 'treinamento'){ ?>

					<p>Tipo: TREINAMENTO</p>

					<?php }else if($totalAgendamentos[$i]['tipo_agendamento'] == 'ap-projeto'){?>

					<p>Tipo: APRESENTAÇÃO</p>

					<?php }else if($totalAgendamentos[$i]['tipo_agendamento'] == 'foto'){?>

					<p>Tipo: FOTO</p>

					<?php }else{?>

					<p>Tipo: VENDA</p>

					<?php } ?>

					<div style="display: flex; flex-direction: row-reverse">	
						<i onclick="mostrarMenuDias(<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>)" class="fa-solid fa-calendar-days"></i>

						<div class="escolher-dia-agendamento-wrapper" id="escolher-dia-agendamento<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>">
							
							<?php for($r = 1; $r < 5; $r++){ ?>

							<div class="escolher-dia-agendamento">
								<?php 
									$escolherDiaSemana = array("", "S", 'T', 'Q', 'Q', 'S', 'S');
									for($j = 0; $j < 6; $j++){
								?>

								<?php if($j == 0){?>

								<p style="border-right: 1px solid white"><?php echo $r ?>°</p>

								<?php }else{?>

								<p onclick="mudarDiaSemana(<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>, <?php echo $j-1?>, <?php echo $r-1 ?>)"><?php echo $escolherDiaSemana[$j] ?></p>

								<?php } ?>

								<?php } ?>	
							</div>

							<?php } ?>
							
						</div>

						<i onclick="editarAgendamento(<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>)" style="margin-right: 10px" class="fa-solid fa-pen-to-square"></i>

					</div>

				</div>

				<?php } ?><!-- FIM DO IF -->

				<?php } ?><!-- FIM DO FOR "i" -->

			</div>
		</div>

		<div class="semanas-tarefa-quadro-wrapper">

			<?php for($k = 0; $k < 4; $k++){?>
				<div class="semanas-tarefa-quadro">
					<?php for($i = 0; $i < 5; $i++){?>
					<div class="tarefas-quadro">
						<div class="header-tarefas-a-fazer">
							<?php 
								//$idSemana = $totalSemanaTarefa[$k]['id_semana_quadro_tarefa'];

								$diaSemana = array("S", 'T', 'Q', 'Q', 'S');
							?>
							
							<h2><?php echo $diaSemana[$i]?></h2>
							
						</div>

						<div class="tarefas-a-fazer-box-wrapper">
							<?php for($w = 0; $w < count($totalAgendamentos); $w++){ ?>

							<?php if($totalAgendamentos[$w]['status_agendamento'] == 'agendado'){ ?>

							<?php if($totalAgendamentos[$w]['semana_agendamento'] == $k){ ?>

							<?php if($totalAgendamentos[$w]['dia_agendamento'] == $i){ ?>

							<div class="tarefas-a-fazer-box">			
								<h2 style="margin-bottom: 10px"><?php echo $totalAgendamentos[$w]['cliente_agendamento'] ?></h2>

								<h4><?php echo $totalAgendamentos[$w]['titulo_agendamento'] ?></h4>

								<?php 
									$dataHora = explode(' ', $totalAgendamentos[$w]['data_agendamento']);

									$dataFormatada = explode('-', $dataHora[0]);
								?>

								<p style="font-size: 12px">Data: <?php echo $dataFormatada[2]. '/' .$dataFormatada[1]. '/' .$dataFormatada[0]. ' <br>Horário: ' .$dataHora[1] ?></p>

								<form class="editar-agendamento" id="editar-agendamento<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>" action="../Model/modelEditarAgendamento.php?id=<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>" method="POST">
									<input style="width: 100%; margin-top: 5px" type="datetime-local" name="dataHoraAgendamento">
									<button style="cursor: pointer;background-color: black; color: white; font-size: 14px; border: none; padding: 2px 5px; margin-top: 5px">EDITAR</button>
								</form>

								<?php if($totalAgendamentos[$w]['tipo_agendamento'] == 'treinamento'){ ?>

								<p>Tipo: TREINAMENTO</p>

								<?php }else if($totalAgendamentos[$w]['tipo_agendamento'] == 'ap-projeto'){?>

								<p>Tipo: APRESENTAÇÃO</p>

								<?php }else{?>

								<p>Tipo: VENDA</p>

								<?php } ?>

								<div style="display: flex; flex-direction: row-reverse">

									<i onclick="concluirAgendamento(<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>)" style="margin-left: 10px" class="fa-solid fa-circle-check"></i>

									<i onclick="mostrarMenuDias(<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>)" class="fa-solid fa-calendar-days"></i>

									<i onclick="editarAgendamento(<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>)" style="margin-right: 10px" class="fa-solid fa-pen-to-square"></i>

									<div class="escolher-dia-agendamento-wrapper" id="escolher-dia-agendamento<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>">
										
										<?php for($r = 1; $r < 5; $r++){ ?>

										<div class="escolher-dia-agendamento">
											<?php 
												$escolherDiaSemana = array("", "S", 'T', 'Q', 'Q', 'S', 'S');
												for($j = 0; $j < 6; $j++){
											?>

											<?php if($j == 0){?>

											<p style="border-right: 1px solid white"><?php echo $r ?>°</p>

											<?php }else{?>

											<p onclick="mudarDiaSemana(<?php echo $totalAgendamentos[$w]['id_agendamento'] ?>, <?php echo $j-1?>, <?php echo $r-1 ?>)"><?php echo $escolherDiaSemana[$j] ?></p>

											<?php } ?>

											<?php } ?>	
										</div>

										<?php } ?>
										
									</div>
								</div>
							</div>

							<?php } ?><!-- FIM DO IF QUE VERIFICA DIA -->

							<?php } ?><!-- FIM DO IF QUE VERIFICA SEMANA -->

							<?php } ?><!-- FIM DO IF QUE VERIFICA STATUS-->

							<?php } ?><!-- FIM DO FOR "i" -->

						</div><!-- FIM tarefas-a-fazer-box-wrapper -->
					</div>
					<?php }?>
				</div>
			<?php }?>
			
		</div>		

		<div class="tarefas-a-fazer">
			<div class="header-tarefas-a-fazer">
				<h2>CONCLUÍDO</h2>
			</div>

			<div class="tarefas-a-fazer-box-wrapper">

				<?php for($i = 0; $i < count($totalAgendamentos); $i++){ ?>

				<?php if($totalAgendamentos[$i]['status_agendamento'] == 'concluido'){ ?>

				<div class="tarefas-a-fazer-box">	
					
					<h2 style="margin-bottom: 10px"><?php echo $totalAgendamentos[$i]['cliente_agendamento'] ?></h2>

					<h4><?php echo $totalAgendamentos[$i]['titulo_agendamento'] ?></h4>

					<?php 
						$dataHora = explode(' ', $totalAgendamentos[$i]['data_agendamento']);

						$dataFormatada = explode('-', $dataHora[0]);
					?>

					<p style="font-size: 12px">Data: <?php echo $dataFormatada[2]. '/' .$dataFormatada[1]. '/' .$dataFormatada[0]. ' <br>Horário: ' .$dataHora[1] ?></p>

					<?php if($totalAgendamentos[$i]['tipo_agendamento'] == 'treinamento'){ ?>

					<p>Tipo: TREINAMENTO</p>

					<?php }else if($totalAgendamentos[$i]['tipo_agendamento'] == 'ap-projeto'){?>

					<p>Tipo: APRESENTAÇÃO</p>

					<?php }else{?>

					<p>Tipo: VENDA</p>

					<?php } ?>

					<div style="display: flex; flex-direction: row-reverse">

						<i onclick="excluirAgendamento(<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>)" style="margin-left: 10px" class="fa-solid fa-trash-can"></i>

						<i onclick="mostrarMenuDias(<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>)" class="fa-solid fa-calendar-days"></i>

						<div class="escolher-dia-agendamento-wrapper" id="escolher-dia-agendamento<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>">
							
							<?php for($r = 1; $r < 5; $r++){ ?>

							<div class="escolher-dia-agendamento">
								<?php 
									$escolherDiaSemana = array("", "S", 'T', 'Q', 'Q', 'S', 'S');
									for($j = 0; $j < 6; $j++){
								?>

								<?php if($j == 0){?>

								<p style="border-right: 1px solid white"><?php echo $r ?>°</p>

								<?php }else{?>

								<p onclick="mudarDiaSemana(<?php echo $totalAgendamentos[$i]['id_agendamento'] ?>, <?php echo $j-1?>, <?php echo $r-1 ?>)"><?php echo $escolherDiaSemana[$j] ?></p>

								<?php } ?>

								<?php } ?>	
							</div>

							<?php } ?>
							
						</div>
					</div>

				</div>

				<?php } ?><!-- FIM DO IF -->

				<?php } ?><!-- FIM DO FOR "i" -->

			</div>
		</div>

	</section>		

	<div class="janela-modal-cadastro-tarefa modal-cadastro-solicitacao janela-modal-geral">
		<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
		<div class="header-janela-modal">
			<h2>Cadastrar agendamento:</h2>
		</div>

		<div class="info-cadastro-cliente">
			<form method="POST" action="../Model/modelCadastroAgendamento.php" enctype="multipart/form-data">

				<div class="campos-formulario-container">
					
					<div class="campos-formulario">
						<div>
							<label>Título:</label>
							<input type="text" placeholder="Título" name="titulo-agendamento" style="text-align: center; width: 200px">
						</div>

						<div>
							<label>Cliente:</label>
							<select name="nome-cliente">
								<option><?php echo ' '?></option>
								<?php 
									include_once("../Model/modelClientes.php");
									for($i = 0; $i < count($totalClientes); $i++){
								?>
								<option value="<?php echo $totalClientes[$i]['nome_cliente']?>"><?php echo $totalClientes[$i]['nome_cliente']?></option>
								<?php }?>
							</select>
						</div>
					</div>				

					<div class="campos-formulario">
						<div>
							<label>Tipo:</label>

							<div class="opcoes-agendamento-cliente">
								<input type="radio" value="venda" name="tipo-agendamento" required><span style="font-size: 20px; margin-left: 5px">Venda</span>
								<input style="margin-left: 10px" type="radio" value="ap-projeto" name="tipo-agendamento" required><span style="font-size: 20px; margin-left: 5px">Ap. Projeto</span>
								<input style="margin-left: 10px" type="radio" value="treinamento" name="tipo-agendamento" required><span style="font-size: 20px; margin-left: 5px">Treinamento</span>
								<input style="margin-left: 10px" type="radio" value="foto" name="tipo-agendamento" required><span style="font-size: 20px; margin-left: 5px">Foto</span>
							</div>
						</div>
					</div>

					<div class="campos-formulario">
						<div>
							<label>Descrição:</label>
							<textarea name="descricao-agendamento"></textarea>
						</div>
						
						<div>
							<label>Data:</label><br>
							<input type="datetime-local" name="data-agendamento">
						</div>
					</div>

					<div class="campos-formulario-botao">
						<button>CONFIRMAR</button>
					</div>
				</div>				
				
			</form>
		</div>
	</div>	

	<script type="text/javascript">

		function editarAgendamento(id){
			$('#editar-agendamento'+id).css('display', 'block');
		}

		function mostrarMenuDias(id){
			$('#escolher-dia-agendamento'+id).slideToggle();
		}

		$('.mudar-dia-tarefa').mouseleave(function(){
			$('.mudar-dia-tarefa').css('display', 'none');
		});

		function mudarDiaSemana(id, dia, semana){
			document.location = '../Model/modelMudarStatusAgendamento.php?id='+id+'&dia='+dia+'&semana='+semana;
		}

		function concluirAgendamento(id){
			document.location = '../Model/modelConcluirAgendamento.php?id='+id;
		}

		function excluirAgendamento(id){		

			var result = confirm("Confirmar exclusão do agendamento?"); 

	        if (result == true) { 
	            document.location = '../Model/modelExcluirAgendamento.php?id='+id;
	        }
		}

		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('.janela-modal-cadastro-tarefa').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			//$('tr:nth-child(2n)').css('background-color', 'white');
		}
		
		function cadastroSolicitacao(){
			//$('.janela-modal-cadastro-tarefa').css('display', 'block');
			$('.janela-modal-cadastro-tarefa').slideToggle();
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			//$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function excluirTarefa(id){
			var id = id;
	        var doc; 
	        var result = confirm("Confirmar exclusão da tarefa?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirTarefa.php?id="+id; 
	            window.location.replace(doc);
	        }	        
		}
	</script>

<?php }else{?>
	<!-- CASO O USUARIO LOGADO NÃO SEJA 'ADM' OU 'MASTER'
		ELE VERÁ ESSA MENSAGEM NA TELA -->
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>