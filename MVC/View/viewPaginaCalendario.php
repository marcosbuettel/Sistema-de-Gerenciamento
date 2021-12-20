<?php 
	//PÁGINA ONDE FICA O CALENDÁRIO E SEUS BLOCOS 

	include_once('../Controller/controllerFormatarData.php');
	include_once("../../body/headCalendarios.php");
	include_once("../Model/modelBancoDeDados.php");
	$idCalendario = $_GET['id'];
	include_once("../Model/modelVerificarCalendario.php");
?>

<?php 
	$idCliente = $totalCalendario[0]['id_cliente'];
	include("../Model/modelCalendarioCliente.php");

	//CONDIÇÃO PARA VERIFICAR SE O USUARIO LOGADO É 'ADM', 'MASTER'
	//OU É O CLIENTE QUE ESTÁ LIGADO A ESSE CALENDÁRIO
	if($_SESSION['nome-cliente'] == $totalCalendarioCliente[0]['nome_cliente'] or $_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){
?>

	<section class="header-calendario">
		<div class="logo-header-calendario">
			<img src="../../images/logoiSeven2.png">
		</div>
		
		<div class="name-icon">
			<img src="../../images/calendar-icon.png">
			<?php 
				$idCliente = $totalCalendario[0]['id_cliente'];
				$_SESSION['idCliente'] = $idCliente;
				include("../Model/modelCalendarioCliente.php");
			?>
			<h2><?php echo $totalCalendario[0]['mes_calendario']?></h2>
		</div>

		<h2><?php echo $totalCalendarioCliente[0]['nome_cliente']?></h2>

	</section><!-- FIM DO HEADER-CALENDARIO -->

	<section class="header-calendario-mobile">
		<div class="logo-header-calendario-mobile">
			<img src="../../images/logoiSeven2.png">
		</div>

		<div class="name-icon">
			<div>
				<img src="../../images/calendar-icon.png">
				<?php 
					$idCliente = $totalCalendario[0]['id_cliente'];
					$_SESSION['idCliente'] = $idCliente;
					include("../Model/modelCalendarioCliente.php");
				?>
				<h2><?php echo $totalCalendario[0]['mes_calendario']?></h2>
			</div>
			
			<h2><?php echo $totalCalendarioCliente[0]['nome_cliente']?></h2>
		</div>

		

	</section><!-- FIM DO HEADER-CALENDARIO -->

	<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

		<?php if($totalCalendario[0]['planilha_calendario'] == null){?>
		<a href="viewCalendarios.php">
			<div class="voltar-pagina-calendario">
				<i class="fas fa-arrow-circle-left"></i>
				<p>Voltar</p>
			</div>
		</a>
		<?php }else{?>
		<a href="viewPrazos.php">
			<div class="voltar-pagina-calendario">
				<i class="fas fa-arrow-circle-left"></i>
				<p>Voltar</p>
			</div>
		</a>
		<?php }?>
	<?php }else{?>
		<a href="viewCalendariosPorCliente.php">
			<div class="voltar-pagina-calendario">
				<i class="fas fa-arrow-circle-left"></i>
				<p>Voltar</p>
			</div>
		</a>
	<?php }?>

	<!-- CONDIÇÃO PRA VER SE NÃO FOR O CALENDÁRIO COMPLETO,
		NÃO EXIBIR OS FILTROS -->
	<?php if($totalCalendario[0]['planilha_calendario'] == null){?>
	<section class="filtros-wrapper">

		<div class="filtros-box">
			<p>Tipo: </p>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=feed">Feed</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=story">Story</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=reels">Reels</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=igtv">IGTV</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=youtube">Youtube</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=blog">Blog</a>
		</div>

		<!--<div class="status-box">
			<p>Status: </p>
			<a href="#">1º Produção</a>
			<a href="#">2º Agendado</a>
			<a href="#">3º Publicado</a>
		</div>-->

	</section><!-- FIM DO FILTROS-WRAPPER -->
	<?php }?>

	<section class="calendario-wrapper">

		<div class="dias-wrapper">
			<p>Segunda</p>
			<p>Terça</p>
			<p>Quarta</p>
			<p>Quinta</p>
			<p>Sexta</p>
			<p>Sábado</p>
			<p>Domingo</p>
		</div>

		<?php 
			$cont = 0;
			for ($i = 0; $i < $totalCalendario[0]['qtd_semanas_calendario'] ; $i++){ 
				$cont++;
		?>
		<div class="calendario-box-wrapper">
			<?php 
				//VERIFICAR O DIA DA SEMANA PARA EXIBIR OS BLOCOS
				//NA ORDEM CERTA, REFERENTES AO DIA DA SEMANA
				//QUE ELE FOI CADASTRADO
				for($j = 0; $j < 7;$j++){
					
					$verificador = false;					
					$verificaSemana = $i;

					if($j == 0){
						$verificaDia = 'segunda';
						include("../Model/modelBlocoCalendario.php");							
					}
					else if($j == 1){
						$verificaDia = 'terca';
						include("../Model/modelBlocoCalendario.php");					
					}
					else if($j == 2){
						$verificaDia = 'quarta';
						include("../Model/modelBlocoCalendario.php");					
					}
					else if($j == 3){
						$verificaDia = 'quinta';
						include("../Model/modelBlocoCalendario.php");					
					}
					else if($j == 4){
						$verificaDia = 'sexta';
						include("../Model/modelBlocoCalendario.php");					
					}
					else if($j == 5){
						$verificaDia = 'sabado';
						include("../Model/modelBlocoCalendario.php");					
					}
					else if($j == 6){
						$verificaDia = 'domingo';
						include("../Model/modelBlocoCalendario.php");					
					}
					
					if(count($totalBlocosCalendarios) != 0){
						$verificador = true;
					}

					if(isset($totalBlocosCalendarios[0]['numero_semana_bloco_calendario'])){	
						if($i != $totalBlocosCalendarios[0]['numero_semana_bloco_calendario']){
							$verificador = false;
						}
					}//NESSA CONDIÇÃO, SE O BLOCO NÃO FOR DAQUELA SEMANA, 
					 //ELE NÃO IRÁ APARECER	

					if(isset($totalBlocosCalendarios[0]['numero_semana_bloco_calendario'])){
						$idBlocoCalendario = $totalBlocosCalendarios[0]['id_bloco_calendario'];
					}

					if($verificador == false){
								
			?>	
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<div style="cursor: pointer;" class="calendario-box-vazia" onclick="cadastroBlocoCalendario(<?php echo $j ?>, <?php echo $i ?>)">
						<img src="../../images/calendar-icon.png">
					</div>	
				<?php }else{?>
					<div style="cursor: pointer;" class="calendario-box-vazia">
						<img src="../../images/calendar-icon.png">
					</div>
				<?php }?>
			
			<?php 
				}else{ 
			?>
				<div class="calendario-box" 
				style="
					<?php 
						//CONDIÇÃO PARA MUDAR A COR DO BLOCO
						//DE ACORDO COM O TIPO QUE ELE FOI CADASTRADO
						if($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "feed"){
					?>
					
					background-color: #34D399!important;

					<?php 
						}elseif($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "story"){
					?>

					background-color: #60A5FA!important;

					<?php 
						}elseif($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "reels"){
					?>

					background-color: #F472B6!important;

					<?php 
						}elseif($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "igtv"){
					?>

					background-color: #1D4ED8!important;

					<?php 
						}elseif($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "youtube"){
					?>

					background-color: #F87171!important;

					<?php 
						}elseif($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "blog"){
					?>

					background-color: #FBBF24!important;

					<?php }else{ ?>

						background-color: #60A5FA!important;

					<?php }?>	
				">	
					<!-- SE NÃO FOR 'ADM' OU 'MASTER' 
						NÃO VAI APARECER BOTAO DE 
						DE EDITAR OU EXCLUIR BLOCO-->
					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<div class="img-close">
							<img src="../../images/edit.png"onclick="editarBloco(<?php echo $idBlocoCalendario?>,<?php echo $idCalendario?>)">
							<img src="../../images/close2.png"onclick="confirmarExcluir(<?php echo $idBlocoCalendario?>,<?php echo $idCalendario?>)">
						</div>
					<?php }else{?>

						<div style="margin-bottom: 25px"></div>
						
					<?php }?>

					<div class="dia-status">					
						<p>
						<?php 
							//CONDIÇÃO PARA VERIFICAR SE O DIA
							//E O MÊS SÃO MENORES QUE 10, PARA 
							//ACRESCENTAR UM '0' ANTES, POIS
							//NO BANCO DE DADOS ELE NÃO SALVA
							//COM O '0'
							if($totalBlocosCalendarios[0]['dia_bloco_calendario'] < 10){
								echo "0" .$totalBlocosCalendarios[0]['dia_bloco_calendario'];	
							}
							else{
								echo $totalBlocosCalendarios[0]['dia_bloco_calendario'];	
							}
							if($totalCalendario[0]['planilha_calendario'] == null){
								echo "/";

								if($totalBlocosCalendarios[0]['mes_bloco_calendario'] < 10){
									echo "0" .$totalBlocosCalendarios[0]['mes_bloco_calendario'];	
								}
								else{
									echo $totalBlocosCalendarios[0]['mes_bloco_calendario'];	
								}
							}
						?>
							
						</p>						

						<div style="background-color: white; color: black; border-radius: 10px;  padding: 0 5px; padding-top: 5px;"><b>Prazo:</b> 
							<?php echo formatarData($totalBlocosCalendarios[0]['prazo_bloco_calendario']);?>
						</div>
					</div>
					<br>
					<?php if($totalCalendario[0]['planilha_calendario'] == null){?>

					
					
					
					<div class="producao-bloco-calendario" id="producao-bloco-calendario-agendado<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>" style="display: none">				
						<p>AGENDADO</p>
					</div>

					<div class="producao-bloco-calendario" id="producao-bloco-calendario-producao<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>" style="display: none">				
						<p>PUBLICADO</p>
					</div>

					<?php if($totalBlocosCalendarios[0]['producao_bloco_calendario'] != null){?>
					<div class="producao-bloco-calendario" id="producao-bloco-calendario-avulso<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>">				
						<p><?php echo strtoupper($totalBlocosCalendarios[0]['producao_bloco_calendario'])?></p>
					</div>
					<?php }?>


					<p style="font-weight: bold; font-size: 14px">Tema:</p>
					<p style="font-size: 14px; margin-top: 5px"><?php echo $totalBlocosCalendarios[0]['tema_bloco_calendario']?></p>
					<div class="separador"></div>
					<div class="botao-calendario">
						<button onclick="janelaDescricao(<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>, <?php echo $idCalendario?>)">Descrição</button>

						<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
							<div class="muda-status-bloco">
								<i class="fas fa-ellipsis-v" onmouseover="abrirMudaStatus(<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>)"></i>
								<div class="muda-status-bloco-lista" id="muda-status<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>">
									<ul>
										<li class="muda-status-agendado" id="<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>">AGENDADO</li>
										<li class="muda-status-publicado" id="<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>">PUBLICADO</li>
									</ul>
								</div>
							</div>
						<?php }?>
						
					</div>
					<?php }?>

					<?php if($totalCalendario[0]['planilha_calendario'] != null){?>
					<textarea readonly style=""><?php echo $totalBlocosCalendarios[0]['descricao_bloco_calendario']?></textarea>
					<?php }?>
					<?php 
						//include("../Controller/controllerCardAprovado.php");
					?>
				</div>

			<?php } }?><!-- FIM DO FOR E DO IF -->	

		</div>

		<?php 
				//CONDIÇÃO PARA DAR UM ESPAÇAMENTO A CADA 
				//DUAS SEMANAS PASSADAS NO CALENDÁRIO
				if($i == 1 or $i == 3){
					echo "<br><br>";
				}
			} 
		?><!-- FIM DO FOR EXTERNO -->


		<?php if($totalCalendario[0]['planilha_calendario'] == null){?>
		<div class="janela-cadastro-bloco-calendario">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo bloco</h2>
			</div>

			<div class="info-cadastro-bloco-calendario">
				<form method="POST" action="../Model/modelCadastroBloco.php?tipo=0">

					<input name="id-calendario" value="<?php echo $idCalendario?>" hidden>
					<input name="semana-bloco" id="semana-bloco" hidden>
					<input type="text" name="dia-bloco" id="dia-bloco" hidden>

					<div class="info-cadastro-bloco-calendario-box">
						<label>Tipo de bloco:</label><br>
						<div class="tipo-bloco">
							<div>
								<input type="radio" name="tipo-bloco" value="feed" required>
								<label>FEED</label>
							</div>

							<div>
								<input type="radio" name="tipo-bloco" value="story" required>
								<label>STORY</label>
							</div>

							<div>
								<input type="radio" name="tipo-bloco" value="reels" required>
								<label>REELS</label>
							</div>

							<div>
								<input type="radio" name="tipo-bloco" value="igtv"required>
								<label>IGTV</label>
							</div>

							<div>
								<input type="radio" name="tipo-bloco" value="youtube"required>
								<label>YOUTUBE</label>
							</div>

							<div>
								<input type="radio" name="tipo-bloco" value="blog" required>
								<label>BLOG</label>
							</div>
						</div><!-- FIM TIPO BLOCO -->
					</div><!-- FIM INFO-CADASTRO-BLOCO-CALENDARIO -->
					<br>
					<div class="info-cadastro-bloco-calendario-box dia-mes-bloco">
						<div>
							<label>Dia: </label>
							<input name="dia-do-bloco" type="number" min="1" max="31" required>
						</div>

						<div>
							<label>Mês: </label>
							<input name="mes-do-bloco" type="number" min="1" max="12" required>
						</div>
					</div>
					<br>
					<div class="info-cadastro-bloco-calendario-box">
						<div class="tema-bloco">
							<label>Prazo: </label><br>
							<input name="prazo-arte-bloco" type="date" required>
						</div>							
						<br>

						<div class="tema-bloco">
							<label>Tema: </label><br>
							<input name="tema-bloco" type="text" required>
						</div>							
						<br>

						<div class="tema-bloco">
							<label>Descrição: </label><br>
							<textarea name="descricao-bloco" required></textarea>
						</div>							
						<br>

						<!--<label>Etapa:</label><br>
						<div class="tipo-bloco">
							<div>
								<input type="radio" name="etapa-bloco" value="1º Produção">
								<label>1º Produção</label>
							</div>

							<div>
								<input type="radio" name="etapa-bloco" value="2º Agendado">
								<label>2º Agendado</label>
							</div>

							<div>
								<input type="radio" name="etapa-bloco" value="3º Publicado">
								<label>3º Publicado</label>
							</div>
						</div>-->
					</div>
					<div class="botao-cadastro-bloco">
						<button>CONFIRMAR</button>
					</div>
				</form>
			</div>
		</div>
		
		<?php }else{?>
		<div class="janela-cadastro-bloco-calendario">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo bloco</h2>
			</div>

			<div class="info-cadastro-bloco-calendario">
				<form method="POST" action="../Model/modelCadastroBloco.php?tipo=1">

					<input name="id-calendario" value="<?php echo $idCalendario?>" hidden>
					<input name="semana-bloco" id="semana-bloco" hidden>
					<input type="text" name="dia-bloco" id="dia-bloco" hidden>

					<br>
					<div class="info-cadastro-bloco-calendario-box dia-mes-bloco">
						<div>
							<label>Dia: </label>
							<input name="dia-do-bloco" type="number" min="1" max="31" required>
						</div>

						<!--<div>
							<label>Mês: </label>
							<input name="mes-do-bloco" type="number" min="1" max="12" required>
						</div>-->
					</div>
					<br>
					<div class="info-cadastro-bloco-calendario-box">

						<div class="tema-bloco">
							<label>Descrição: </label><br>
							<textarea name="descricao-bloco" required></textarea>
						</div>							
						<br>
					</div>
					<div class="botao-cadastro-bloco">
						<button>CONFIRMAR</button>
					</div>
				</form>
			</div>
		</div>
		<?php }?>

	</section><!-- FIM DO CALENDARIO-WRAPPER -->

	<script type="text/javascript">
		
		//FUNÇÃO PARA PEGAR AS INFORMAÇÕES DO BLOCO CLICADO
		//(DIA DA SEMANA, SEMANA DO BLOCO)
		//PARA PODER SALVAR NO BANCO QUAL DIA ELE PERTENCE
		function cadastroBlocoCalendario(diaSemana, semanaBloco){
			var diaSemana = diaSemana;
			var semanaBloco = semanaBloco;
			var diaSemanaConvertido;

			if(diaSemana == 0){
				diaSemanaConvertido = 'segunda';
			}
			else if(diaSemana == 1){
				diaSemanaConvertido = 'terca';
			}
			else if(diaSemana == 2){
				diaSemanaConvertido = 'quarta';
			}
			else if(diaSemana == 3){
				diaSemanaConvertido = 'quinta';
			}
			else if(diaSemana == 4){
				diaSemanaConvertido = 'sexta';
			}
			else if(diaSemana == 5){
				diaSemanaConvertido = 'sabado';
			}
			else if(diaSemana == 6){
				diaSemanaConvertido = 'domingo';
			}

			document.getElementById('dia-bloco').value = diaSemanaConvertido;
			document.getElementById('semana-bloco').value = semanaBloco;

			$('.janela-cadastro-bloco-calendario').css('display', 'block');
		}

		//FUNÇÃO PARA PEGAR OS ID'S DO BLOCO E DO CALENDARIO
		//E ENVIAR PARA PÁGINA DE EDIÇÃO DO BLOCO
		function editarBloco(idBlocoCalendario, idCalendario){
			var idBlocoCalendario = idBlocoCalendario;
			var idCalendario = idCalendario;

			document.location = 'viewEditarBlocoCalendario.php?id='+idCalendario+'&idB='+idBlocoCalendario ;
		}

		//FUNÇÃO PARA ABRIR A JANELA QUE MOSTRA O CONTEÚDO
		//DE CADA BLOCO
		function janelaDescricao(idBloco, idCalendario){
			var idBloco = idBloco;		
			var idCalendario = idCalendario;

			document.location = 'viewPaginaCalendarioDescricao.php?id='+idCalendario+'&idB='+idBloco;
		}

		//FUNÇÃO PARA FECHAR A JANELA DE CADASTRO DO BLOCO
		function fecharJanelaModal(){
			$('.janela-cadastro-bloco-calendario').css('display', 'none');	
		}

		function editarCliente(){
			$('.janela-modal-editar').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function fecharJanelaModalEditar(){
			$('.janela-modal-editar').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		//FUNÇÃO PARA CONFIRMAR A EXCLUSÃO DO BLOCO
		function confirmarExcluir(idBlocoCalendario, idCalendario){
			var idBlocoCalendario = idBlocoCalendario;
			var idCalendario = idCalendario;
			
	        var doc; 
	        var result = confirm("Confirmar exclusão do bloco?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirBlocoCalendario.php?id="+idBlocoCalendario+"&idC="+idCalendario; 
	        } else { 
	            doc = "viewPaginaCalendario.php?id="+idCalendario; 
	        } 

	        window.location.replace(doc);
		}

		$('.muda-status-agendado').click(function(){
			var id_bloco_calendario = $(this).attr('id');
			$.ajax({
				method: 'post',
				data:{'id': id_bloco_calendario, 'tipo': 'agendado'},
				url: '../Model/modelEditarAndamentoBlocoCalendario.php'
			}).done(function(){
				$('#producao-bloco-calendario-avulso'+id_bloco_calendario).css('display', 'none');
				$('#producao-bloco-calendario-agendado'+id_bloco_calendario).css('display', 'block');
				$('#producao-bloco-calendario-producao'+id_bloco_calendario).css('display', 'none');
			});

		});

		$('.muda-status-publicado').click(function(){
			var id_bloco_calendario = $(this).attr('id');
			$.ajax({
				method: 'post',
				data:{'id': id_bloco_calendario, 'tipo': 'publicado'},
				url: '../Model/modelEditarAndamentoBlocoCalendario.php'
			}).done(function(){
				$('#producao-bloco-calendario-avulso'+id_bloco_calendario).css('display', 'none');
				$('#producao-bloco-calendario-producao'+id_bloco_calendario).css('display', 'block');
				$('#producao-bloco-calendario-agendado'+id_bloco_calendario).css('display', 'none');
			});

		});

		function abrirMudaStatus(id){
			$('#muda-status'+id).css('display', 'block');
		}

		$('.muda-status-bloco-lista').mouseleave(function(){
			$('.muda-status-bloco-lista').css('display', 'none');
		});

	</script>

<?php }else{?>
	<div class="separador">
		<h2>Desculpe, página não encontrada.</h2>
	</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php include_once("../../body/footerCalendario.php");?>