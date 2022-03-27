<?php 
	//PÁGINA PARA MOSTRAR OS CALENDÁRIOS, PORÉM SÓ COM OS BLOCOS
	//QUE FAZEM PARTE DO FILTRO QUE FOI MARCADO
	include_once("../../body/headCalendarios.php");
	include_once("../Model/modelBancoDeDados.php");
	$idCalendario = $_GET['id'];
	include_once("../Model/modelVerificarCalendario.php");
	include_once("../Model/modelVerificarCalendario.php");

	$nomeFiltro = $_GET['filtro'];
?>

<?php 
	$idCliente = $totalCalendario[0]['id_cliente'];
	include("../Model/modelCalendarioCliente.php");

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

	<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
		<a href="viewCalendarios.php">
			<div class="voltar-pagina-calendario">
				<i class="fas fa-arrow-circle-left"></i>
				<p>Voltar</p>
			</div>
		</a>
	<?php }else{?>
		<a href="viewCalendariosPorCliente.php">
			<div class="voltar-pagina-calendario">
				<i class="fas fa-arrow-circle-left"></i>
				<p>Voltar</p>
			</div>
		</a>
	<?php }?>

	<section class="filtros-wrapper">

		<div class="filtros-box">
			<p>Tipo: </p>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=feed">Feed</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=story">Story</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=reels">Reels</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=igtv">IGTV</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=youtube">Youtube</a>
			<a href="viewPaginaCalendarioFiltrado.php?id=<?php echo $idCalendario?>&filtro=blog">Blog</a>
			<a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>">x Limpar Filtros</a>
		</div>

		<!--<div class="status-box">
			<p>Status: </p>
			<a href="#">1º Produção</a>
			<a href="#">2º Agendado</a>
			<a href="#">3º Publicado</a>
		</div>-->

	</section><!-- FIM DO FILTROS-WRAPPER -->

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
				<?php if($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == $nomeFiltro){?>

				<div class="calendario-box" 
				style="
					<?php 
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
						}else{
					?>

					background-color: #FBBF24!important;

					<?php } ?>
				">	
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
							if($totalBlocosCalendarios[0]['dia_bloco_calendario'] < 10){
								echo "0" .$totalBlocosCalendarios[0]['dia_bloco_calendario'];	
							}
							else{
								echo $totalBlocosCalendarios[0]['dia_bloco_calendario'];	
							}

							echo "/";

							if($totalBlocosCalendarios[0]['mes_bloco_calendario'] < 10){
								echo "0" .$totalBlocosCalendarios[0]['mes_bloco_calendario'];	
							}
							else{
								echo $totalBlocosCalendarios[0]['mes_bloco_calendario'];	
							}
						?>
							
						</p>
						<?php if($totalBlocosCalendarios[0]['producao_bloco_calendario'] != null){?>
						<p><?php echo $totalBlocosCalendarios[0]['producao_bloco_calendario']?></p>
					<?php }?>
					</div>
					<br>
					<p style="font-weight: bold; font-size: 14px">Tema:</p>
					<p style="font-size: 14px; margin-top: 5px"><?php echo $totalBlocosCalendarios[0]['tema_bloco_calendario']?></p>
					<div class="separador"></div>
					<div class="botao-calendario">
						<button onclick="janelaDescricao(<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>, <?php echo $idCalendario?>)">Descrição</button>
						
					</div>
					
					<?php 
						//include("../Controller/controllerCardAprovado.php");
					?>
				</div>
				<?php }else{?>
					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
						<div style="cursor: pointer;" class="calendario-box-vazia" onclick="cadastroBlocoCalendario(<?php echo $j ?>, <?php echo $i ?>)">
							<img src="../../images/calendar-icon.png">
						</div>	
					<?php }else{?>
						<div style="cursor: pointer;" class="calendario-box-vazia">
							<img src="../../images/calendar-icon.png">
						</div>
					<?php }?>
				<?php }?>

			<?php } }?><!-- FIM DO FOR E DO IF -->	

		</div>

		<?php 
				if($i == 1){
					echo "<br><br>";
				}
			} 
		?><!-- FIM DO FOR EXTERNO -->

		<div class="janela-cadastro-bloco-calendario">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo bloco</h2>
			</div>

			<div class="info-cadastro-bloco-calendario">
				<form method="GET" action="../Model/modelCadastroBloco.php">

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
							<label>Tema: </label><br>
							<input name="tema-bloco" type="text" required>
						</div>							
						<br>

						<div class="tema-bloco">
							<label>Descrição: </label><br>
							<textarea name="descricao-bloco" required></textarea>
						</div>							
						<br>

						<label>Etapa:</label><br>
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
						</div>
					</div>
					<div class="botao-cadastro-bloco">
						<button>CONFIRMAR</button>
					</div>
				</form>
			</div>
		</div>

	</section><!-- FIM DO CALENDARIO-WRAPPER -->

	<script type="text/javascript">
		
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

		function editarBloco(idBlocoCalendario, idCalendario){
			var idBlocoCalendario = idBlocoCalendario;
			var idCalendario = idCalendario;

			document.location = 'viewEditarBlocoCalendario.php?id='+idCalendario+'&idB='+idBlocoCalendario ;
		}

		function janelaDescricao(idBloco, idCalendario){
			var idBloco = idBloco;		
			var idCalendario = idCalendario;

			document.location = 'viewPaginaCalendarioDescricao.php?id='+idCalendario+'&idB='+idBloco;
		}

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

		function confirmarExcluir(idBlocoCalendario, idCalendario){
			var idBlocoCalendario = idBlocoCalendario;
			var idCalendario = idCalendario;
			
	        var doc; 
	        var result = confirm("Confirmar exclusão do bloco?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirBlocoCalendario.php?id="+idBlocoCalendario+"&idC="+idCalendario; 
	            window.location.replace(doc);
	        }	        
		}

	</script>

<?php }else{?>
	<div class="separador">
		<h2>Desculpe, página não encontrada.</h2>
	</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php include_once("../../body/footerCalendario.php");?>