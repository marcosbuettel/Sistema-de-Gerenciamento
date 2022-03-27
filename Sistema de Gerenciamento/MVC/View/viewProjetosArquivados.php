<?php 
	//PÁGINA PARA VISUALIZAR TODOS OS CALENDARIOS 
	//CADASTRADOS NO SISTEMA
	
	if(isset($_POST['pesquisar-tarefas'])){
		$tarefaBuscada = $_POST['pesquisar-tarefas'];	
	}
	

	include_once("../View/viewHead.php");
	include('../Controller/controllerFormatarData.php');
	include('../Controller/controllerTarefaAtrasada.php');
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelUsuariosAdm.php");
	include_once("../Model/modelProjetos.php");	
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
			<li>Projetos arquivados</li>
			
		</ul>

	</section>

	<section class="calendario-box-wrapper separador tabela-box-wrapper">

		<div class="pesquisar-tarefas-projetos-wrapper">
			<div class="pesquisar-tarefas-projetos">
				<form method="POST" action="viewProjetos.php">
					<input type="text" name="pesquisar-tarefas" placeholder="Pesquisar...">
					<div class="lupa-pesquisa">
						<button><i class="fas fa-search"></i></button>
					</div>
				</form>
			</div>
		</div>

		<div class="projetos-wrapper">

			<?php for($i = 0; $i < count($totalProjetos); $i++){?>
				<?php if($totalProjetos[$i]['arquivado_projeto'] == 1){?>
				<div class="projetos-box">
					<div class="projetos-box-header">
						<h2 onclick="abrirListaProjetos(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-sort-down"></i> <?php echo $totalProjetos[$i]['nome_projeto']?></h2>

						<!--<div>
							<h2>Total de tarefas: 10</h2>
							<h2>Atrasadas: 2 <i class="fas fa-exclamation-circle" style="color: red"></i></h2>
						</div>-->

						<div>

							<button onclick="desarquivarProjeto(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-folder-open"></i> DESARQUIVAR</button>
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

								<td><?php echo formatarData($totalTarefasProjeto[$j]['prazo_tarefa_projeto'])?> <i class="fas fa-exclamation-circle" style="color: red"></i></td>									
								<?php }?>

								<td><?php echo $totalTarefasProjeto[$j]['responsavel_tarefa_projeto']?></td>
								<td><?php echo strtoupper($totalTarefasProjeto[$j]['tipo_tarefa_projeto'])?></td>

								<td>
									<?php if($totalTarefasProjeto[$j]['status_tarefa_projeto'] == 'andamento'){?>
									<i class="fas fa-running" onmouseover="exibirAndamento(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
									<div class="popup-acao" id="tarefa-andamento<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">ANDAMENTO</div>
									<?php }else{?>
									<i class="fas fa-check-circle" onmouseover="exibirFinalizada(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
									<div class="popup-acao" id="tarefa-finalizada<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">FINALIZADA</div>
									<?php }?>	
								</td>

								<td style="min-width: 160px">
									<div class="acoes-tarefa">
										<i class="fas fa-trash-alt" onclick="excluirTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)" onmouseover="exibirExcluirTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
										<div class="excluir-tarefa" id="excluir-tarefa<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">EXCLUIR</div>

										<?php if($totalTarefasProjeto[$j]['status_tarefa_projeto'] == 'andamento'){?>
										<i class="fas fa-check-circle" onclick="finalizarTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)" onmouseover="exibirFinalizarTarefa(<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>)"></i>
										<div class="finaliza-tarefa" id="finalizar-tarefa<?php echo $totalTarefasProjeto[$j]['id_tarefa_projeto']?>">FINALIZAR</div>

										<?php }?>
									</div>
								</td>

							</tr>		

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
										<input type="radio" name="tipo-tarefa" value="web"><label>WEB</label>
										<input type="radio" name="tipo-tarefa" value="design"><label>Design</label>
										<input type="radio" name="tipo-tarefa" value="copy"><label>Copy</label>
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
						<h2>Cadastro de novo projeto</h2>
					</div>

					<div class="info-cadastro-cliente">
						<form method="POST" action="../Model/modelEditarProjeto.php?idP=<?php echo $totalProjetos[$i]['id_projeto']?>">

							<div class="campos-formulario-container">
								<div class="campos-formulario">
									<div>
										<label>Nome:</label>
										<input type="text" name="nome-projeto" value="<?php echo $totalProjetos[$i]['nome_projeto']?>">
									</div>

									<div>
										<label>Tipo:</label>
										<input type="radio" name="tipo-projeto" value="web" 
										<?php if($totalProjetos[$i]['tipo_projeto'] == 'web'){?>
										checked	
										<?php }?>
										><label>WEB</label>
										<input type="radio" name="tipo-projeto" value="design"
										<?php if($totalProjetos[$i]['tipo_projeto'] == 'design'){?>
										checked	
										<?php }?>
										><label>Design</label>
										<input type="radio" name="tipo-projeto" value="copy"
										<?php if($totalProjetos[$i]['tipo_projeto'] == 'copy'){?>
										checked	
										<?php }?>
										><label>Copy</label>
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

			<?php }?><!-- FIM DO FOR 'i' -->
			
		</div>

		<div class="janela-modal-cadastro modal-cadastro-projeto janela-modal-geral" id="janela-modal-0">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo projeto</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastrarProjeto.php">

					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Nome:</label>
								<input type="text" name="nome-projeto">
							</div>

							<div>
								<label>Tipo:</label>
								<input type="radio" name="tipo-projeto" value="web"><label>WEB</label>
								<input type="radio" name="tipo-projeto" value="design"><label>Design</label>
								<input type="radio" name="tipo-projeto" value="copy"><label>Copy</label>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Responsável:</label>
								<select name="responsavel-projeto">
									<?php for($i = 0; $i < count($totalUsuariosAdm); $i++){?>
										<option><?php echo strtoupper($totalUsuariosAdm[$i]['nome_usuario'])?></option>
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

		
	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		function cadastroProjeto(id){
			$('#janela-modal-'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function editaProjeto(id){
			$('#janela-modal-edit'+id).css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		//FUNÇÃO PARA FECHAR A JANELA DE CADASTRO DO CALENDARIO
		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function abrirListaProjetos(id){
			$('#projetos-lista'+id).slideToggle();
		}

		function exibirExcluirTarefa(id){
			$('#excluir-tarefa'+id).css('display', 'block');
		}

		$('.fa-trash-alt').mouseleave(function(){
			$('.excluir-tarefa').css('display', 'none');	
		});

		function exibirFinalizarTarefa(id){
			$('#finalizar-tarefa'+id).css('display', 'block');
		}

		$('.fa-check-circle').mouseleave(function(){
			$('.finaliza-tarefa').css('display', 'none');	
		});

		function exibirAndamento(id){
			$('#tarefa-andamento'+id).css('display', 'block');
		}

		$('.fa-running').mouseleave(function(){
			$('.popup-acao').css('display', 'none');	
		});

		function exibirFinalizada(id){
			$('#tarefa-finalizada'+id).css('display', 'block');
		}

		$('.fa-check-circle').mouseleave(function(){
			$('.popup-acao').css('display', 'none');	
		});

		function excluirTarefa(id){
			var idTarefa = id;
	        var doc; 
	        var result = confirm("Confirmar exclusão da tarefa?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirTarefaProjeto.php?id="+idTarefa; 
	        } else { 
	            doc = "viewProjetos.php"; 
	        } 

	        window.location.replace(doc);
		}

		function finalizarTarefa(id){
			var idTarefa = id;
	        var doc; 
	        var result = confirm("Finalizar tarefa?"); 

	        if (result == true) { 
	            doc = "../Model/modelFinalizarTarefaProjeto.php?id="+idTarefa; 
	            window.location.replace(doc);
	        }	        
		}	

		function desarquivarProjeto(id){
			document.location = '../Model/modelDesarquivarProjeto.php?id='+id;
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