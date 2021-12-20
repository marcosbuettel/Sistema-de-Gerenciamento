<?php 
	//PÁGINA PARA VISUALIZAR AS TAREFAS REFERENTE AOS BLOCOS 
	//CADASTRADOS EM CADA CALENDÁRIO
	
	include_once('../Controller/controllerTarefaAtrasada.php');
	include_once('../Controller/controllerVerificarP.php');
	include_once('../Controller/controllerFormatarData.php');
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelCalendarios.php");
	include_once("../Model/modelTarefasClientes.php");
	include_once("../Model/modelSemanaQuadroTarefa.php");
	include_once("../Model/modelTarefas.php");
?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Quadro de Tarefas</li>
			<div class="lista-nav-painel">
				<li><a href="#" onclick="cadastroSolicitacao()">ADICIONAR TAREFA</a></li>
				<li><a href="../Model/modelAdicionarSemanaQuadroTarefas.php">ADICIONAR SEMANA</a></li>
			</div>
		</ul>

	</section>

	<section class="separador quadro-de-tarefas">
		
		<div class="tarefas-a-fazer">
			<div class="header-tarefas-a-fazer">
				<h2>A FAZER</h2>
			</div>

			<div class="tarefas-a-fazer-box-wrapper">
				<?php for($i = 0; $i < count($totalTarefas); $i++){?>
					<?php if($totalTarefas[$i]['dia_semana_tarefa'] == 999 && $totalTarefas[$i]['status_tarefa'] != 'finalizado'){?>
						<div class="tarefas-a-fazer-box">
							<div class="tarefas-info">
								<?php if($totalTarefas[$i]['tipo_tarefa'] != 'solicitacao'){?>
									<a href="viewPaginaCalendario.php?id=<?php echo $totalTarefas[$i]['id_calendario']?>">
										<div style="display: flex">								
											<i class="far fa-eye" style="margin-top: 2px; margin-right: 2px"></i>						
											<h2><?php echo $totalTarefas[$i]['nome_cliente_tarefa']?></h2>		
										</div>
									</a>
								<?php }else{?>
									<div style="display: flex; flex-direction: column">
										<details>
											<summary>
												<div style="display: flex">	
													<i class="far fa-eye" style="margin-top: 2px; margin-right: 2px"></i>
													<h2><?php echo $totalTarefas[$i]['nome_cliente_tarefa']?></h2>
												</div>
											</summary><?php echo $totalTarefas[$i]['descricao_tarefa']?>						
										</details>		
										
									</div>
									
								<?php }?>
								<h2><?php echo ucfirst($totalTarefas[$i]['p_tarefa'])?></h2>
							</div>
							<p><?php echo $totalTarefas[$i]['mes_calendario_tarefa']?></p>
							<div style="display: flex; justify-content: space-between;">
								<p><b>Prazo:</b> <?php echo formatarData($totalTarefas[$i]['prazo_tarefa'])?></p>

								<div>
									<i class="fas fa-trash-alt" onmouseover="exibirExcluirTarefa(<?php echo $totalTarefas[$i]['id_tarefa']?>)" style="margin-right: 5px" onclick="excluirTarefa(<?php echo $totalTarefas[$i]['id_tarefa']?>)"></i>
									<div class="excluir-tarefa" id="excluir-tarefa<?php echo $totalTarefas[$i]['id_tarefa']?>">EXCLUIR TAREFA</div>


									<i class="far fa-calendar-alt" onmouseover="mostrarMenuDias(<?php echo $totalTarefas[$i]['id_tarefa']?>)"></i>
								</div>
								<div class="mudar-dia-tarefa" id="mudarDiaTarefa<?php echo $totalTarefas[$i]['id_tarefa']?>">
									<?php for($l = 0; $l < count($totalSemanaTarefa); $l++){?>
										<div class="mudar-dia-tarefa-box" id="mudarDiaTarefa<?php echo $totalTarefas[$i]['id_tarefa']?>">
											<ul>
												<li><?php echo ($l+1).'°'?></li>
												<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$i]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=0"><li>S</li></a>
												<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$i]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=1"><li>T</li></a>
												<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$i]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=2"><li>Q</li></a>
												<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$i]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=3"><li>Q</li></a>
												<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$i]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=4"><li>S</li></a>
												<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$i]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=5"><li>S</li></a>
											</ul>
										</div>
									<?php }?>
								</div>
							</div>							
						</div>

					<?php }?>
				<?php }?>
			</div>
		</div>

		<div class="semanas-tarefa-quadro-wrapper">

			<?php for($k = 0; $k < count($totalSemanaTarefa); $k++){?>
				<div class="semanas-tarefa-quadro">
					<?php for($i = 0; $i < 6; $i++){?>
					<div class="tarefas-quadro">
						<div class="header-tarefas-a-fazer">
							<?php 
								$idSemana = $totalSemanaTarefa[$k]['id_semana_quadro_tarefa'];

								$diaSemana = array("S", 'T', 'Q', 'Q', 'S', 'S');
							?>
							<?php 
								//CRIEI ESSA VARIAVEL PARA VERIFICAR SE A SEMANA
								//ESTÁ VAZIA, PARA ENTÃO PODER EXCLUIR
								$verificaSemanaVazia = false;

								for($j = 0; $j < count($totalTarefas); $j++){
									if(isset($totalTarefas[$j]['id_semana_tarefa'])){
										if(isset($totalSemanaTarefa[$k]['id_semana_quadro_tarefa'])){
											if($totalTarefas[$j]['id_semana_tarefa'] == $totalSemanaTarefa[$k]['id_semana_quadro_tarefa']){
											$verificaSemanaVazia = true;
											}
										}
									}
								}

								if($i == 0 && $verificaSemanaVazia == false){

							?>
							<div class="botao-exclui-semana" style="position: relative;">
								<i onmouseover="exibeFuncao('excluirSemana', <?php echo $idSemana?>)" onclick="excluirSemanaQuadroTarefas(<?php echo $idSemana?>)" class="far fa-trash-alt" style="position: absolute; left: 0; top: 5px;cursor: pointer;"></i>
								<div class="icones-acao" id="excluirSemana<?php echo $idSemana?>" style="margin-top: 30px">EXCLUIR SEMANA</div>
								<h2><?php echo $diaSemana[$i]?></h2>
							</div>
							<?php }else{?>
							
							<h2><?php echo $diaSemana[$i]?></h2>
							
							<?php }?>
						</div>

						<div class="tarefas-a-fazer-box-wrapper">
							<?php for($j = 0; $j < count($totalTarefas); $j++){?>
								<?php if($totalTarefas[$j]['dia_semana_tarefa'] == $i && $totalTarefas[$j]['id_semana_tarefa'] == $totalSemanaTarefa[$k]['id_semana_quadro_tarefa'] && $totalTarefas[$j]['status_tarefa'] != 'finalizado'){?>
									<div class="tarefas-a-fazer-box">
										<div class="tarefas-info">
											<?php if($totalTarefas[$j]['tipo_tarefa'] != 'solicitacao'){?>
												<a href="viewPaginaCalendario.php?id=<?php echo $totalTarefas[$j]['id_calendario']?>">
													<div style="display: flex">								
														<i class="far fa-eye" style="margin-top: 2px; margin-right: 2px"></i>						
														<h2><?php echo $totalTarefas[$j]['nome_cliente_tarefa']?></h2>		
													</div>
												</a>
											<?php }else{?>
												<div style="display: flex; flex-direction: column">
													<details>
														<summary>
															<div style="display: flex">	
																<i class="far fa-eye" style="margin-top: 2px; margin-right: 2px"></i>
																<h2><?php echo $totalTarefas[$j]['nome_cliente_tarefa']?></h2>
															</div>
														</summary><?php echo $totalTarefas[$j]['descricao_tarefa']?>						
													</details>		
													
												</div>
												
											<?php }?>
											<h2><?php echo ucfirst($totalTarefas[$j]['p_tarefa'])?></h2>
										</div>
										<p><?php echo $totalTarefas[$j]['mes_calendario_tarefa']?></p>
										<p><b>Prazo:</b> <?php echo formatarData($totalTarefas[$j]['prazo_tarefa'])?></p>
										<div style="display: flex; flex-direction: row-reverse;">
											<i class="fas fa-trash-alt" onmouseover="exibirExcluirTarefa(<?php echo $totalTarefas[$j]['id_tarefa']?>)" style="margin-left: 10px" onclick="excluirTarefa(<?php echo $totalTarefas[$j]['id_tarefa']?>)"></i>
											<div class="excluir-tarefa" id="excluir-tarefa<?php echo $totalTarefas[$j]['id_tarefa']?>" style="bottom: -15px; right: -30px">EXCLUIR TAREFA</div>

											<i class="fas fa-check-circle" style="margin-left: 10px" onmouseover="mostrarFinalizarTarefa(<?php echo $totalTarefas[$j]['id_tarefa']?>)" onclick="finalizarTarefa(<?php echo $totalTarefas[$j]['id_tarefa']?>)"></i>

											<i class="fas fa-tasks" style="margin-left: 10px;" onclick="abrirTarefas(<?php echo $totalTarefas[$j]['id_tarefa']?>)" onmouseover="verTarefas(<?php echo $totalTarefas[$j]['id_tarefa']?>)"></i>

											<i class="far fa-calendar-alt" onmouseover="mostrarMenuDias(<?php echo $totalTarefas[$j]['id_tarefa']?>)"></i>

											<div class="ver-tarefa" id="verTarefa<?php echo $totalTarefas[$j]['id_tarefa']?>">
												VER TAREFAS
											</div>

											<div class="finalizar-tarefa" id="mudarFinalizarTarefa<?php echo $totalTarefas[$j]['id_tarefa']?>">
												FINALIZAR TAREFA
											</div>
											<div class="mudar-dia-tarefa" id="mudarDiaTarefa<?php echo $totalTarefas[$j]['id_tarefa']?>">
												<?php for($l = 0; $l < count($totalSemanaTarefa); $l++){?>
													<div class="mudar-dia-tarefa-box">
														<ul>
															<li><?php echo ($l+1).'°'?></li>
															<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$j]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=0"><li>S</li></a>
															<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$j]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=1"><li>T</li></a>
															<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$j]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=2"><li>Q</li></a>
															<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$j]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=3"><li>Q</li></a>
															<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$j]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=4"><li>S</li></a>
															<a href="../Model/modelMudarDiaSemana.php?idT=<?php echo $totalTarefas[$j]['id_tarefa']?>&idS=<?php echo $totalSemanaTarefa[$l]['id_semana_quadro_tarefa']?>&dia=5"><li>S</li></a>
														</ul>
													</div>
												<?php }?><!-- FIM FOR 'l' -->
											</div>
										</div>
									</div>
								<?php }?><!-- FIM IF -->

								<div class="janela-modal-cadastro janela-modal-tarefas" id="janela-tarefas<?php echo $totalTarefas[$j]['id_tarefa']?>">
									<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
									<div class="header-janela-modal">
										<h2>Tarefas</h2>
									</div>

									<div class="lista-tarefas">
										<table>
											<tr>
												<th>Tarefa</th>
												<th>Data Copy</th>
												<th>Data Design</th>
												<th>Prazo</th>
												<th>Período</th>
												<th></th>
											</tr>

											<?php 
												$idTarefa = $totalTarefas[$j]['id_tarefa'];
												include('../Model/modelBlocoPorTarefa.php'); 
											?>

											<?php for($m = 0; $m < count($totalBlocoPorTarefa); $m++){?>
				
													<tr>
														
														<td><a href="viewPaginaCalendario.php?id=<?php echo $totalBlocoPorTarefa[$m]['id_calendario']?>"><i class="far fa-eye" style="margin-top: 2px; margin-right: 5px"></i><?php echo $totalBlocoPorTarefa[$m]['tema_bloco_calendario'];?></a></td>
														
														
														<td>
															<?php 
																$periodo = $totalBlocoPorTarefa[$m]['numero_semana_bloco_calendario'];

																//[$periodo == true -> P1]
																//[$periodo == false -> P2]
																if(verificarP($periodo) == true){
																	if(tarefaAtrasada($totalTarefasClientes[$i]['p1_copy_calendario']) == true){
																		echo formatarData($totalTarefasClientes[$i]['p1_copy_calendario'])." <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
																	}else{
																		echo formatarData($totalTarefasClientes[$i]['p1_copy_calendario']);
																	}
																	
																}else{
																	if(tarefaAtrasada($totalTarefasClientes[$i]['p2_copy_calendario']) == true){
																		echo formatarData($totalTarefasClientes[$i]['p2_copy_calendario'])." <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
																	}else{
																		echo formatarData($totalTarefasClientes[$i]['p2_copy_calendario']);
																	}
																}
															?>							
														</td>

														<td>
															<?php 
																$periodo = $totalBlocoPorTarefa[$m]['numero_semana_bloco_calendario'];

																//[$periodo == true -> P1]
																//[$periodo == false -> P2]
																if(verificarP($periodo) == true){
																	if(tarefaAtrasada($totalTarefasClientes[$i]['p1_arte_calendario']) == true){
																		echo formatarData($totalTarefasClientes[$i]['p1_arte_calendario'])." <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
																	}else{
																		echo formatarData($totalTarefasClientes[$i]['p1_arte_calendario']);
																	}
																}else{
																	if(tarefaAtrasada($totalTarefasClientes[$i]['p2_arte_calendario']) == true){
																		echo formatarData($totalTarefasClientes[$i]['p2_arte_calendario'])." <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
																	}else{
																		echo formatarData($totalTarefasClientes[$i]['p2_arte_calendario']);
																	}
																}
															?>							
														</td>			
														
														<td><?php echo formatarData($totalBlocoPorTarefa[$m]['prazo_bloco_calendario']);?></td>	

														<td>
															<?php 
																$periodo = $totalBlocoPorTarefa[$m]['numero_semana_bloco_calendario'];

																//[$periodo == true -> P1]
																//[$periodo == false -> P2]
																if(verificarP($periodo) == true){
																	echo "<b>P1</b>";
																	
																}else{
																	echo "<b>P2</b>";
																}
															?>							
														</td>

														<td>
															<?php if($totalBlocoPorTarefa[$m]['status_tarefa'] != 'finalizado'){?>
																<i class="far fa-check-circle icone-finalizar" id="<?php echo $totalBlocoPorTarefa[$m]['id_bloco_calendario']?>" onmouseover="exibeConcluirTarefaLista(<?php echo $totalBlocoPorTarefa[$m]['id_bloco_calendario']?>)"></i>
															<?php }else{?>
																<i class="fas fa-check-circle"></i>	
															<?php }?>
															<i class="fas fa-check-circle icone-finalizado" id="iconeFinalizado<?php echo $totalBlocoPorTarefa[$m]['id_bloco_calendario']?>"></i>
															<div class="concluir-tarefa" id="tarefa-listada<?php echo $totalBlocoPorTarefa[$m]['id_bloco_calendario']?>">CONCLUIR TAREFA</div>
														</td>	

													</tr>												
											
											<?php }?><!-- FIM DO FOR DO 'j' -->
										</table>
									</div>
								</div>		
							<?php }?><!-- FIM FOR 'j'-->
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
				<?php for($i = 0; $i < count($totalTarefas); $i++){?>
					<?php if($totalTarefas[$i]['status_tarefa'] == 'finalizado'){?>
						<div class="tarefas-a-fazer-box">
							<div class="tarefas-info">
								<a href="viewPaginaCalendario.php?id=<?php echo $totalTarefas[$i]['id_calendario']?>">
									<div style="display: flex">
										<i class="far fa-eye" style="margin-top: 2px; margin-right: 2px"></i>
										<h2><?php echo $totalTarefas[$i]['nome_cliente_tarefa']?></h2>		
									</div>
								</a>
								<h2><?php echo ucfirst($totalTarefas[$i]['p_tarefa'])?></h2>
							</div>
							<p><?php echo $totalTarefas[$i]['mes_calendario_tarefa']?></p>
							<div style="display: flex; justify-content: space-between;">
								<p><b>Prazo:</b> <?php echo formatarData($totalTarefas[$i]['prazo_tarefa'])?></p>
								<div>
									<i class="fas fa-clipboard-check"></i>
									<i class="fas fa-trash-alt" onmouseover="exibirExcluirTarefa(<?php echo $totalTarefas[$i]['id_tarefa']?>)" style="margin-left: 10px" onclick="excluirTarefa(<?php echo $totalTarefas[$i]['id_tarefa']?>)"></i>
									<div class="excluir-tarefa" id="excluir-tarefa<?php echo $totalTarefas[$i]['id_tarefa']?>" style="bottom: -15px; right: -15px">EXCLUIR TAREFA</div>
								</div>
							</div>							
						</div>

					<?php }?>
				<?php }?>
			</div>
		</div>

	</section>		

	<div class="janela-modal-cadastro-tarefa modal-cadastro-solicitacao janela-modal-geral">
		<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
		<div class="header-janela-modal">
			<h2>Cadastrar solicitação:</h2>
		</div>

		<div class="info-cadastro-cliente">
			<form method="POST" action="../Model/modelCadastroTarefa.php" enctype="multipart/form-data">

				<div class="campos-formulario-container">
					
					<div class="campos-formulario">
						<div>
							<label>Título:</label>
							<input type="text" placeholder="Título" name="titulo-solicitacao" style="text-align: center; width: 200px">
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

							<div class="opcoes-solicitacao-cliente">
								<input type="radio" value="web" name="tipo-solicitacao" required>WEB
								<input type="radio" value="midiasocial" name="tipo-solicitacao" required>Midia Social
								<input type="radio" value="outdoor" name="tipo-solicitacao" required>Outdoor
								<input type="radio" value="folder" name="tipo-solicitacao" required>Folder
								<input type="radio" value="outro" name="tipo-solicitacao" required>Outro
							</div>
						</div>
					</div>

					<div class="campos-formulario">
						<div>
							<label>Descrição:</label>
							<textarea name="descricao-solicitacao"></textarea>
						</div>
						
						<div>
							<label>Informe o prazo:</label><br>
							<input type="date" name="prazo-solicitacao">
						</div>
					</div>

					<div class="campos-formulario-botao">
						<button>CONFIRMAR</button>
					</div>
				</div>

				<!--<div class="anexar-foto">
					<input type="checkbox" name="anexar-foto" value="1" onclick="enviarFoto()"> ANEXAR FOTO?
					<br>
					<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
				</div>-->				
				
			</form>
		</div>
	</div>	

	<script type="text/javascript">

		//UTILIZANDO AJAX PARA CONCLUIR AS TAREFAS SEM DAR REFRESH NA PÁGINA

		$('.icone-finalizar').click(function() {

			var id_bloco_calendario = $(this).attr('id');
			$.ajax({
				method: 'post',
				data:{'id': id_bloco_calendario},
				url: '../Model/modelEditarStatusBlocoCalendario.php'
			}).done(function(){
				$('#'+id_bloco_calendario).css('display', 'none');
				$('#iconeFinalizado'+id_bloco_calendario).css('display', 'block');
			});
		})

		$('.icone-finalizado').click(function() {

			var id_bloco_calendario = $(this).attr('id');
			$.ajax({
				method: 'post',
				data:{'id': id_bloco_calendario},
				url: '../Model/modelEditarStatusBlocoCalendario.php'
			}).done(function(){
				$('#'+id_bloco_calendario).css('display', 'none');
				$('#iconeFinalizado'+id_bloco_calendario).css('display', 'block');
			});
		})


		function exibeFuncao(funcao, id){
			if(funcao == 'excluirSemana'){
				$('#excluirSemana'+id).css('display', 'block');
			}	
		}

		$('.botao-exclui-semana i').mouseleave(function(){
			$('.icones-acao').css('display', 'none');
		});

		function excluirSemanaQuadroTarefas(idSemana){
			document.location = '../Model/modelExcluirSemanaQuadroTarefas.php?id='+idSemana;
		}

		function mostrarMenuDias(id){
			$('#mudarDiaTarefa'+id).css('display', 'block');
		}

		$('.mudar-dia-tarefa').mouseleave(function(){
			$('.mudar-dia-tarefa').css('display', 'none');
		});

		function mostrarFinalizarTarefa(id){
			$('#mudarFinalizarTarefa'+id).css('display', 'block');
		}

		$('.fa-check-circle').mouseleave(function(){
			$('.finalizar-tarefa').css('display', 'none');
		});

		$('.fa-tasks').mouseleave(function(){
			$('.ver-tarefa').css('display', 'none');
		});
		

		function finalizarTarefa(id){
			document.location = '../Model/modelFinalizarTarefa.php?id='+id;
		}

		function verTarefas(id) {
			$('#verTarefa'+id).css('display', 'block');
		}
		
		function abrirTarefas(id){
			$('#janela-tarefas'+id).css('display', 'block');
		}

		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('.janela-modal-cadastro-tarefa').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			//$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function exibeConcluirTarefaLista(id){
			$('#tarefa-listada'+id).css('display', 'block');
		}

		$('.fa-check-circle').mouseleave(function(){
			$('.concluir-tarefa').css('display', 'none');
		});

		function concluirTarefaListada(id){
			document.location = '../Model/modelConcluirTarefaListada.php?id='+id;
		}

		function cadastroSolicitacao(){
			$('.janela-modal-cadastro-tarefa').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			//$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function exibirExcluirTarefa(id){
			$('#excluir-tarefa'+id).css('display', 'block');
		}

		$('.fa-trash-alt').mouseleave(function(){
			$('.excluir-tarefa').css('display', 'none');
		});

		function excluirTarefa(id){
			var id = id;
	        var doc; 
	        var result = confirm("Confirmar exclusão da tarefa?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirTarefa.php?id="+id; 
	        } else { 
	            doc = "viewQuadroTarefas.php"; 
	        } 

	        window.location.replace(doc);
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