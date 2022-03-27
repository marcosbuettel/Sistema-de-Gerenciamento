<?php 
	//PÁGINA PARA VISUALIZAR AS TAREFAS REFERENTE AOS BLOCOS 
	//CADASTRADOS EM CADA CALENDÁRIO
	
	include_once('../Controller/controllerTarefaAtrasada.php');
	include_once('../Controller/controllerVerificarP.php');
	include_once('../Controller/controllerFormatarData.php');
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelCalendarios.php");
	//include_once("../Model/modelTarefasClientes.php");
	include_once("../Model/modelClientes.php");


	if($_GET['tipo'] == 'p1'){

	$verificaTarefasClientes = $pdo->prepare("SELECT * FROM clientes INNER JOIN calendario ON clientes.id_cliente = calendario.id_cliente ORDER BY p1_arte_calendario ");

	}else{
		$verificaTarefasClientes = $pdo->prepare("SELECT * FROM clientes INNER JOIN calendario ON clientes.id_cliente = calendario.id_cliente ORDER BY p2_arte_calendario ");
	}

	$verificaTarefasClientes->execute();
	$totalTarefasClientes = $verificaTarefasClientes->fetchAlL(); 

?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Tarefas</li>
			<div class="filtro-tipo-tarefas">
				<p>OCULTAR:</p>
				<li><input type="checkbox" id="tipo-calendario" value="calendario">CALENDÁRIOS</li>
				<li><input type="checkbox" id="tipo-avulsas" value="avulsas">AVULSAS</li>
			</div>
		</ul>

	</section>

	<section class="separador" id="tarefa-calendario">
		<div style="display: flex;justify-content: space-between;">
			<h2 style="margin-bottom: 10px">TAREFAS DE CALENDÁRIOS</h2>
			<div class="filtro-tipo-tarefas">
				<p>ORDENAR POR:</p>
				<li><input type="radio" name="filtro-prazo" id="prazo-p1" value="calendario" onclick="filtrarPorP('p1')">PRAZO P1</li>
				<li><input type="radio" name="filtro-prazo" id="prazo-p2" value="avulsas" onclick="filtrarPorP('p2')">PRAZO P2</li>
				<li><button style="background-color: black; color: white; padding: 4px; cursor: pointer; margin-top: -5px" onclick="limparFiltro()">LIMPAR FILTRO</button></li>
			</div>
		</div>	

		<?php for($i = 0; $i < count($totalTarefasClientes); $i++){
			if($totalTarefasClientes[$i]['planilha_calendario'] != 1){
				$idCalendario = $totalTarefasClientes[$i]['id_calendario'];
				include('../Model/modelBlocoCalendarioAtivo.php');	
		?>
		
		<?php if(count($totalBlocoAtivo) != 0){?>
		<div class="header-tarefas" id="<?php echo $idCalendario;?>" onclick="abreTarefas(<?php echo $idCalendario;?>)">
			
			<div>
				<h2><i class="fas fa-sort-down" style="position: relative;top: -4px; margin-right: 20px"></i> <?php echo $totalTarefasClientes[$i]['nome_cliente']?></h2>
				<h2><i class="fas fa-sort-down" style="color: white; position: relative;top: -4px; margin-right: 20px"></i><?php echo $totalTarefasClientes[$i]['mes_calendario']?></h2>
			</div>

			<?php 
				$contP1 = 0;
				$contP2 = 0;

				for($k = 0; $k < count($totalBlocoAtivo); $k++){
					$periodo = $totalBlocoAtivo[$k]['numero_semana_bloco_calendario'];

					if(verificarP($periodo) == true){
						$contP1++;
					}else{
						$contP2++;
					}
				}
			?>

			<div class="contador-tarefas">
				
				<h2>Prazo: <?php echo formatarData($totalTarefasClientes[$i]['p1_arte_calendario']); ?> - Tarefas P1: <?php echo $contP1?> 
					
					<?php 
						$periodoBuscado = "AND numero_semana_bloco_calendario < 2";

						//CONTAR TODOS OS BLOCOS, VERIFICANDO SE EXISTE
						//ALGUM QUE AINDA NÃO FOI PARA PRODUÇÃO
						//VER SE VAI TER NECESSIDADE

						include('../Model/modelVerificaSemanaBlocoCalendario.php');		

						if(count($totalSemanaBlocoCalendario) > 0){
							if($totalSemanaBlocoCalendario[0]['status_tarefa'] != 'producao' && count($totalSemanaBlocoCalendario) > 0 && $totalSemanaBlocoCalendario[0]['status_tarefa'] != 'finalizado'){
					?>

						<a href="../Model/modelCadastrarTarefaQuadro.php?id=<?php echo $idCalendario?>&nome=<?php echo $totalTarefasClientes[$i]['nome_cliente']?>&mes=<?php echo $totalTarefasClientes[$i]['mes_calendario']?>&periodo=p1&prazo=<?php echo $totalTarefasClientes[$i]['p1_arte_calendario']?>"><i onmouseover="exibeFuncaoP1('p1', <?php echo $idCalendario?>)" class="fas fa-arrow-circle-right" style="position: relative; left: 10px"></i></a>
					<?php }}?>
					
				</h2>

				<div style="z-index: 999"class="icones-acao" id="p1<?php echo $idCalendario?>">ENVIAR P1 PARA PRODUÇÃO</div>

				<h2>Prazo: <?php echo formatarData($totalTarefasClientes[$i]['p2_arte_calendario']); ?> - Tarefas P2: <?php echo $contP2?> 

					<?php 
						$periodoBuscado = "AND numero_semana_bloco_calendario > 1";

						include('../Model/modelVerificaSemanaBlocoCalendario.php');		
						if(count($totalSemanaBlocoCalendario) > 0){
							if($totalSemanaBlocoCalendario[0]['status_tarefa'] != 'producao' && $totalSemanaBlocoCalendario[0]['status_tarefa'] != 'finalizado'){
					?>
					
						<a href="../Model/modelCadastrarTarefaQuadro.php?id=<?php echo $idCalendario?>&nome=<?php echo $totalTarefasClientes[$i]['nome_cliente']?>&mes=<?php echo $totalTarefasClientes[$i]['mes_calendario']?>&periodo=p2&prazo=<?php echo $totalTarefasClientes[$i]['p2_arte_calendario']?>">
							
							
							<i onmouseover="exibeFuncaoP2('p2', <?php echo $idCalendario?>)" class="fas fa-arrow-circle-right" style="position: relative; left: 10px"></i>
							<?php ?>
						</a>
					<?php }}?>
				
				</h2>
				<div class="icones-acao" id="p2<?php echo $idCalendario?>">ENVIAR P2 PARA PRODUÇÃO</div>
			</div>
		</div>
		<?php }?><!-- FIM DO IF QUE VERIFICA SE EXISTEM BLOCOS -->

		<div class="tarefas-wrapper" id="tarefas<?php echo $idCalendario?>">
			<table>
				<tr>
					<th>Tarefa</th>
					<th>Data Copy</th>
					<th>Data Design</th>
					<th>Prazo</th>
					<th>Período</th>
					<th>Status</th>
				</tr>
			<?php for($j = 0; $j < count($totalBlocoAtivo); $j++){?>
				
					<tr>
						
						<td><a href="viewPaginaCalendarioDescricao.php?id=<?php echo $totalBlocoAtivo[$j]['id_calendario']?>&idB=<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>"><i class="far fa-eye" style="margin-top: 2px; margin-right: 5px"></i><?php echo $totalBlocoAtivo[$j]['tema_bloco_calendario'];?></a></td>
						
						
						<td>
							<?php 
								$periodo = $totalBlocoAtivo[$j]['numero_semana_bloco_calendario'];

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
								$periodo = $totalBlocoAtivo[$j]['numero_semana_bloco_calendario'];

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
						
						<td><?php echo formatarData($totalBlocoAtivo[$j]['prazo_bloco_calendario']);?></td>	

						<td>
							<?php 
								$periodo = $totalBlocoAtivo[$j]['numero_semana_bloco_calendario'];

								//[$periodo == true -> P1]
								//[$periodo == false -> P2]
								if(verificarP($periodo) == true){
									/*if(tarefaAtrasada($totalBlocoAtivo[$j]['prazo_bloco_calendario']) == true){
										echo "<b>P1 <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
									}else{*/
									echo "<b>P1</b>";
									//}
								}else{
									/*if(tarefaAtrasada($totalBlocoAtivo[$j]['prazo_bloco_calendario']) == true){
										echo "<b>P2 <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
									}else{*/
									echo "<b>P2</b>";
									//}
								}
							?>							
						</td>

						<td>
							<?php if($totalBlocoAtivo[$j]['status_tarefa'] == 'producao'){?>						
							<i class="fas fa-running" onmouseover="exibeStatusTarefa(<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>, 'producao')"></i>
							<div class="icone-status-tarefa" id="producao<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>"><p>PRODUÇÃO</p></div>
							<?php }else if($totalBlocoAtivo[$j]['status_tarefa'] == 'finalizado'){?>
							<i class="fas fa-clipboard-check" onmouseover="exibeStatusTarefa(<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>, 'concluido')"></i>
							<div class="icone-status-tarefa" id="concluido<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>"><p>CONCLUÍDO</p></div>
							<?php }else{?>
							<i class="fas fa-clock" onmouseover="exibeStatusTarefa(<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>, 'aguardando')"></i>
							<div class="icone-status-tarefa" id="aguardando<?php echo $totalBlocoAtivo[$j]['id_bloco_calendario']?>"><p>AGUARDANDO</p></div>
							<?php }?>
						</td>			
					</tr>
				
			
			<?php }?><!-- FIM DO FOR DO 'j' -->
			</table>
		</div>
		<?php }?><!-- FIM DO IF QUE VERIFICA SE É CALENDARIO -->
		

		<?php }?><!-- FIM DO FOR DO 'i' -->

				
	</section>

	<section class="separador" style="margin-top: -50px" id="tarefa-avulsa">
		<h2 style="margin-bottom: 10px">TAREFAS AVULSAS</h2>
		<?php 
			for($i = 0; $i< count($totalClientes); $i++){
				$idCliente = $totalClientes[$i]['id_cliente'];
				$nomeCliente = $totalClientes[$i]['nome_cliente'];
				include("../Model/modelVerificarSolicitacoes.php");
		?>
		
		<?php if(count($totalSolicitacoes) != 0){?>

		<div class="header-tarefas" id="<?php echo $idCliente;?>" onclick="abreTarefasAvulsas(<?php echo $idCliente;?>)">
			
			<div>
				<h2><i class="fas fa-sort-down" style="position: relative;top: -4px; margin-right: 20px"></i> <?php echo $totalClientes[$i]['nome_cliente']?></h2>
			</div>

			
		</div>

		<div class="tarefas-wrapper" id="tarefasAvulsas<?php echo $idCliente?>">
			<table>
				<tr>
					<th>Tarefa</th>
					<th>Tipo</th>
					<th>Descrição</th>
					<th>Prazo</th>
					<th>Status</th>
					<th></th>
				</tr>
			<?php 
				for($j = 0; $j < count($totalSolicitacoes); $j++){

			?>
				
					<tr>
						
						<td><i class="far fa-eye" style="margin-top: 2px; margin-right: 5px"></i><?php echo $totalSolicitacoes[$j]['titulo_solicitacao_cliente'];?></td>
						
						<td>
							<?php echo ucfirst($totalSolicitacoes[$j]['tipo_solicitacao_cliente']);?>					
						</td>

						<td>
							<details style="cursor: pointer;"><summary>Exibir</summary><?php echo $totalSolicitacoes[$j]['descricao_solicitacao_cliente'];?></details>						
						</td>
						
						<td>
							<?php 
								if(tarefaAtrasada($totalSolicitacoes[$j]['prazo_solicitacao_cliente']) == true){
									echo formatarData($totalSolicitacoes[$j]['prazo_solicitacao_cliente'])." <i style='color: red' class='fas fa-exclamation-circle'></i></b>";
								}else{
									echo formatarData($totalSolicitacoes[$j]['prazo_solicitacao_cliente']);
								}
							?>							
						</td>

						<td>
							<?php if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'producao'){?>						
							<i class="fas fa-running" onmouseover="exibeStatusTarefaAvulsa(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>, 'producao')"></i>
							<div class="icone-status-tarefa" id="producao<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>"><p>PRODUÇÃO</p></div>
							<?php }else if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'finalizado'){?>
							<i class="fas fa-clipboard-check" onmouseover="exibeStatusTarefaAvulsa(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>, 'concluido')"></i>
							<div class="icone-status-tarefa" id="concluido<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>"><p>CONCLUÍDO</p></div>
							<?php }else{?>
							<i class="fas fa-clock" onmouseover="exibeStatusTarefaAvulsa(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>, 'aguardando')"></i>
							<div class="icone-status-tarefa" id="aguardando<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>"><p>AGUARDANDO</p></div>
							<?php }?>
						</td>

						<td>
							<?php if($totalSolicitacoes[$j]['status_solicitacao_cliente'] == 'solicitado'){?>
								<div id="enviar-producao<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
									<i style="cursor: pointer;" class="fas fa-arrow-circle-right icone-enviar-producao" onmouseover="exibeAcaoTarefaAvulsa(<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>)" id="<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>"></i>
									<div class="icone-status-tarefa" id="enviarTarefa<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>"><p>ENVIAR TAREFA PARA PRODUÇÃO</p></div>
								</div>
							<?php }?>

							<div class="enviado-producao" id="enviado-producao<?php echo $totalSolicitacoes[$j]['id_solicitacao_cliente']?>">
								<div style="display: flex;">
									<i class="fas fa-check-circle"></i>
									<p style="margin-left: 5px; margin-top: -2px">ENVIADO PARA PRODUÇÃO</p>
								</div>
							</div>	
						</td>		
					</tr>
				
			
			<?php }?><!-- FIM DO FOR DO 'j' -->
			</table>
		</div>
		<?php }?><!-- FIM DO IF QUE VERIFICA SE EXISTEM SOLICITAÇÕES -->
		

		<?php }?><!-- FIM DO FOR DO 'i' -->

				
	</section>
		

	<script type="text/javascript">

		$('.icone-enviar-producao').click(function() {

			var id_solicitacao_cliente = $(this).attr('id');
			$.ajax({
				method: 'post',
				data:{'id': id_solicitacao_cliente},
				url: '../Model/modelCadastrarTarefaSolicitacaoQuadro.php'
			}).done(function(){
				$('#enviado-producao'+id_solicitacao_cliente).slideToggle();
				$('#enviar-producao'+id_solicitacao_cliente).css('display', 'none');
			});
		})

		function abreTarefas(id){
			$('#tarefas'+id).slideToggle();
		}

		function abreTarefasAvulsas(id){
			$('#tarefasAvulsas'+id).slideToggle();
		}

		function exibeFuncaoP1(funcao, id){
			if(funcao == 'p1'){
				$('#p1'+id).css('display', 'block');
			}	
		}

		function exibeFuncaoP2(funcao, id){
			if(funcao == 'p2'){
				$('#p2'+id).css('display', 'block');
			}	
		}

		function exibeAcaoTarefaAvulsa(id){
			$('#enviarTarefa'+id).css('display', 'block');
		}		

		$('.contador-tarefas i').mouseleave(function(){
			$('.icones-acao').css('display', 'none');
		});

		function exibeStatusTarefa(id, status){
			$('#'+status+id).css('display', 'block');
		}

		function exibeStatusTarefaAvulsa(id, status){
			$('#'+status+id).css('display', 'block');
		}

		$('.fas').mouseleave(function(){
			$('.icone-status-tarefa').css('display', 'none');
		});


		$('#tipo-calendario').change(function(){
			$('#tarefa-calendario').slideToggle();
		});

		$('#tipo-avulsas').change(function(){
			$('#tarefa-avulsa').slideToggle();
		});

		function filtrarPorP(tipoP){
			document.location = 'viewTarefasFiltradas.php?tipo='+tipoP;
		}

		function limparFiltro(){
			document.location = 'viewTarefas.php';	
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