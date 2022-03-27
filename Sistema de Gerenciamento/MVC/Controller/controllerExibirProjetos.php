<?php for($i = 0; $i < count($totalProjetos); $i++){?>
	
	<?php if($totalProjetos[$i]['tipo_projeto'] == $tipoProjeto[$w]){?>

		<?php if($totalProjetos[$i]['arquivado_projeto'] != 1){?>
		<div class="projetos-box">
			<div class="projetos-box-header">
				<h2 onclick="abrirListaProjetos(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-sort-down"></i> <?php echo $totalProjetos[$i]['nome_projeto']; 
					if($totalProjetos[$i]['prazo_projeto'] != null){
					echo ' - Prazo: ' .formatarData($totalProjetos[$i]['prazo_projeto']);
					}
				?>

				</h2>

				<!--<div>
					<h2>Total de tarefas: 10</h2>
					<h2>Atrasadas: 2 <i class="fas fa-exclamation-circle" style="color: red"></i></h2>
				</div>-->

				<div>

					<button onclick="arquivarProjeto(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-folder-open"></i> ARQUIVAR</button>

					<button onclick="editaProjeto(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-edit"></i> EDITAR</button>
					
					<button onclick="cadastroProjeto(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-plus-circle"></i> NOVA TAREFA</button>
				</div>
				
			</div>

			<div class="projetos-box-lista" id="projetos-lista<?php echo $totalProjetos[$i]['id_projeto']?>">
				<table>
					<tr>
						<th>Tarefa</th>
						<th>Descrição</th>
						<th>Prazo</th>
						<th>Responsável</th>
						<th>Tipo</th>
						<th>Prioridade</th>
						<th>Status</th>
						<th></th>
					</tr>

					<?php 
						$idProjeto = $totalProjetos[$i]['id_projeto'];

						include('../Model/modelVerificarTarefasProjeto.php');

						for($j = 0; $j < count($totalTarefasProjeto); $j++){?>

					<tr>
						<td><?php echo $totalTarefasProjeto[$j]['nome_tarefa_projeto']?></td>
						<td><details><summary style="cursor: pointer;">Exibir</summary><?php echo $totalTarefasProjeto[$j]['descricao_tarefa_projeto']?></details></td>
						
						<?php if(tarefaAtrasada($totalTarefasProjeto[$j]['prazo_tarefa_projeto']) == false){?>

						<td><?php echo formatarData($totalTarefasProjeto[$j]['prazo_tarefa_projeto'])?></td>

						<?php }else{?>

						<td><?php echo formatarData($totalTarefasProjeto[$j]['prazo_tarefa_projeto'])?> 

						<?php if($totalTarefasProjeto[$j]['status_tarefa_projeto'] != 'finalizado'){ ?>

							<i class="fas fa-exclamation-circle" style="color: red"></i>

						<?php }?>

						</td>									
						<?php }?>

						<td><?php echo $totalTarefasProjeto[$j]['responsavel_tarefa_projeto']?></td>
						<?php 
							$encoding = mb_internal_encoding();
						?>
						<td><?php echo mb_strtoupper($totalTarefasProjeto[$j]['tipo_tarefa_projeto'], $encoding)?></td>

						<td>
							<?php if($totalTarefasProjeto[$j]['prioridade_tarefa_projeto'] == 1){ echo 'ALTA <i class="fas fa-exclamation-triangle" style="color: red"></i>'?>

							<?php }else if($totalTarefasProjeto[$j]['prioridade_tarefa_projeto'] == 2){ echo 'MÉDIA <i class="fas fa-exclamation-triangle" style="color:yellow"></i>'?>

							<?php }else if($totalTarefasProjeto[$j]['prioridade_tarefa_projeto'] == 3){ echo 'BAIXA <i class="fas fa-exclamation-triangle" style="color: green"></i>'?>

							<?php }?>
						</td>

						<td>
							<?php if($totalTarefasProjeto[$j]['status_tarefa_projeto'] == 'andamento'){?>
							<i class="fas fa-running" id="icone-andamento<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto'] ?>" onmouseover="exibirAndamento(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>

							<i class="fas fa-check-circle icone-finalizada" id="icone-finalizada<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto'] ?>"></i>

							<div class="popup-acao" id="tarefa-andamento<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">ANDAMENTO</div>
							<?php }else{?>
							<i class="fas fa-check-circle" onmouseover="exibirFinalizada(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
							<div class="popup-acao" id="tarefa-finalizada<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">FINALIZADA</div>
							<?php }?>	
						</td>

						<td>
							<div class="acoes-tarefa">
								<i class="fas fa-edit" onclick="editarTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)" onmouseover="exibirEditarTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
								<div class="editar-tarefa" id="editar-tarefa<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">EDITAR</div>

								<i class="fas fa-trash-alt" onclick="excluirTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)" onmouseover="exibirExcluirTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
								<div class="excluir-tarefa" id="excluir-tarefa<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">EXCLUIR</div>

								<?php if($totalTarefasProjeto[$j]['status_tarefa_projeto'] == 'andamento'){?>
								<i class="fas fa-check-circle" id="botao-finalizar-tarefa<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto'] ?>" onclick="finalizarTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)" onmouseover="exibirFinalizarTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>

								<i class="fas fa-check-circle botao-tarefa-finalizada" style="color: #24E924" id="botao-tarefa-finalizada<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto'] ?>" ></i>

								<div class="finaliza-tarefa" id="finalizar-tarefa<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">FINALIZAR</div>

								<?php }?>
							</div>
						</td>

					</tr>

					<!-- JANELA PARA EDITAR A TAREFA -->
					<div class="janela-modal-cadastro modal-cadastro-projeto janela-modal-geral" id="janela-editar-tarefa-<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">
						<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
						<div class="header-janela-modal">
							<h2>Editar tarefa</h2>
						</div>

						<div class="info-cadastro-cliente">
							<form method="POST" action="../Model/modelEditarTarefaProjeto.php?idT=<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">

								<div class="campos-formulario-container">
									<div class="campos-formulario">
										<div>
											<label>Nome:</label>
											<input type="text" name="nome-tarefa" value="<?php echo $totalTarefasProjeto[$j]['nome_tarefa_projeto']?>">
										</div>

										<div>
											<label>Tipo:</label>
											<input type="radio" name="tipo-tarefa" value="web" <?php if($totalTarefasProjeto[$j]['tipo_tarefa_projeto'] == 'web'){?> checked <?php } ?>><label>WEB</label>
											<input type="radio" name="tipo-tarefa" value="design" <?php if($totalTarefasProjeto[$j]['tipo_tarefa_projeto'] == 'design'){?> checked <?php } ?>><label>Design</label>
											<input type="radio" name="tipo-tarefa" value="copy" <?php if($totalTarefasProjeto[$j]['tipo_tarefa_projeto'] == 'copy'){?> checked <?php } ?>><label>Copy</label>

											<input type="radio" name="tipo-tarefa" value="planejamento" <?php if($totalTarefasProjeto[$j]['tipo_tarefa_projeto'] == 'planejamento'){?> checked <?php } ?>><label>Planejamento</label>

											<input type="radio" name="tipo-tarefa" value="gráfica" <?php if($totalTarefasProjeto[$j]['tipo_tarefa_projeto'] == 'gráfica'){?> checked <?php } ?>><label>Gráfica</label>

											<input type="radio" name="tipo-tarefa" value="estratégia" <?php if($totalTarefasProjeto[$j]['tipo_tarefa_projeto'] == 'estratégia'){?> checked <?php } ?>><label>Estratégia</label>
										</div>
									</div>

									<div class="campos-formulario">
										<div>
											<label>Prioridade:</label>
											<input type="radio" name="prioridade-tarefa" value="3" <?php if($totalTarefasProjeto[$j]['prioridade_tarefa_projeto'] == '3'){?> checked <?php } ?>><label>Baixa</label>
											<input type="radio" name="prioridade-tarefa" value="2" <?php if($totalTarefasProjeto[$j]['prioridade_tarefa_projeto'] == '2'){?> checked <?php } ?>><label>Média</label>
											<input type="radio" name="prioridade-tarefa" value="1" <?php if($totalTarefasProjeto[$j]['prioridade_tarefa_projeto'] == '1'){?> checked <?php } ?>><label>Alta</label>
										</div>
									</div>

									<div class="campos-formulario">
										<div>
											<label>Responsável:</label>
											<select name="responsavel-tarefa">
												<?php for($l = 0; $l < count($totalUsuariosAdm); $l++){?>
													<option <?php if(strtoupper($totalTarefasProjeto[$j]['responsavel_tarefa_projeto']) == strtoupper($totalUsuariosAdm[$l]['nome_usuario'])){?> selected <?php } ?>><?php echo strtoupper($totalUsuariosAdm[$l]['nome_usuario'])?></option>
												<?php } ?>
											</select>
										</div>

										<div>
											<label>Prazo:</label>
											<input type="date" name="prazo-tarefa" value="<?php echo $totalTarefasProjeto[$j]['prazo_tarefa_projeto']?>">
										</div>
									</div>

									<div class="campos-formulario" style="padding: 10px">									
										<label>Descrição:</label>
										<textarea name="descricao-tarefa"><?php echo $totalTarefasProjeto[$j]['descricao_tarefa_projeto']?></textarea>		
									</div>

									<div class="campos-formulario-botao">
										<button>CONFIRMAR</button>
									</div>
								</div>
							</form>
						</div>
					</div>		

					<?php }?><!-- FIM DO FOR 'j' -->	
				</table>
			</div>				
		</div>

		<div class="janela-modal-cadastro modal-cadastro-projeto janela-modal-geral" id="janela-modal-<?php echo $totalProjetos[$i]['id_projeto']?>">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de nova tarefa</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastrarTarefaProjeto.php?idP=<?php echo $totalProjetos[$i]['id_projeto']?>">

					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Nome:</label>
								<input type="text" name="nome-tarefa">
							</div>

							<div>
								<label>Tipo:</label>
								<input type="radio" name="tipo-tarefa" value="web" ><label>WEB</label>
								<input type="radio" name="tipo-tarefa" value="design"><label>Design</label>
								<input type="radio" name="tipo-tarefa" value="copy"><label>Copy</label>

								<input type="radio" name="tipo-tarefa" value="planejamento"><label>Planejamento</label>

								<input type="radio" name="tipo-tarefa" value="gráfica"><label>Gráfica</label>

								<input type="radio" name="tipo-tarefa" value="estratégia"><label>Estratégia</label>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Prioridade:</label>
								<input type="radio" name="prioridade-tarefa" value="3" ><label>Baixa</label>
								<input type="radio" name="prioridade-tarefa" value="2"><label>Média</label>
								<input type="radio" name="prioridade-tarefa" value="1"><label>Alta</label>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Responsável:</label>
								<select name="responsavel-tarefa">
									<?php for($k = 0; $k < count($totalUsuariosAdm); $k++){?>
										<option><?php echo strtoupper($totalUsuariosAdm[$k]['nome_usuario'])?></option>
									<?php } ?>
								</select>
							</div>

							<div>
								<label>Prazo:</label>
								<input type="date" name="prazo-tarefa">
							</div>
						</div>

						<div class="campos-formulario" style="padding: 10px">									
							<label>Descrição:</label>
							<textarea name="descricao-tarefa"></textarea>		
						</div>

						<div class="campos-formulario-botao">
							<button>CONFIRMAR</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!-- JANELA PARA EDITAR O PROJETO -->
		<div class="janela-modal-cadastro modal-cadastro-projeto janela-modal-geral" id="janela-modal-edit<?php echo $totalProjetos[$i]['id_projeto']?>">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Editar projeto</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelEditarProjeto.php?idP=<?php echo $totalProjetos[$i]['id_projeto']?>">

					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Nome:</label>
								<input type="text" name="nome-projeto" value="<?php echo $totalProjetos[$i]['nome_projeto']?>">
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Prazo:</label>
								<input type="date" name="prazo-projeto" value="<?php echo $totalProjetos[$i]['prazo_projeto']?>">
							</div>
						</div>

						<div class="campos-formulario">

							<div>
								<label>Tipo:</label><br>

								<input type="radio" name="tipo-projeto" value="id-visual"
								<?php if($totalProjetos[$i]['tipo_projeto'] == 'id-visual'){?>
									checked	
								<?php }?>
								><label>ID Visual</label>


								<input type="radio" name="tipo-projeto" value="mkt-org"
								<?php if($totalProjetos[$i]['tipo_projeto'] == 'mkt-org'){?>
									checked	
								<?php }?>
								><label>MKT - Orgânico</label>


								<input type="radio" name="tipo-projeto" value="mkt-per"
								<?php if($totalProjetos[$i]['tipo_projeto'] == 'mkt-per'){?>
									checked	
								<?php }?>
								><label>MKT - Performance</label>


								<input type="radio" name="tipo-projeto" value="ecommerce"
								<?php if($totalProjetos[$i]['tipo_projeto'] == 'ecommerce'){?>
									checked	
								<?php }?>
								><label>Ecommerce</label><br>


								<input type="radio" name="tipo-projeto" value="institucional"
								<?php if($totalProjetos[$i]['tipo_projeto'] == 'institucional'){?>
									checked	
								<?php }?>
								><label>Institucional</label>
							</div>

						</div>

						

						<div class="campos-formulario">
							<div>
								<label>Responsável:</label>
								<select name="responsavel-projeto">
									<?php for($l = 0; $l < count($totalUsuariosAdm); $l++){?>
										<option 

										<?php if(strtoupper($totalProjetos[$i]['responsavel_projeto']) == strtoupper($totalUsuariosAdm[$l]['nome_usuario'])){?>
										selected	
										<?php }?>
										>
										<?php echo strtoupper($totalUsuariosAdm[$l]['nome_usuario'])?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="campos-formulario-botao">
							<button>CONFIRMAR</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<?php }?><!-- FIM DO IF PARA VERIFICAR SE O PROJETO ESTÁ ARQUIVADO -->

	<?php }?><!-- FIM DO IF PARA VERIFICAR O TIPO DO PROJETO -->

<?php }?><!-- FIM DO FOR 'i' -->