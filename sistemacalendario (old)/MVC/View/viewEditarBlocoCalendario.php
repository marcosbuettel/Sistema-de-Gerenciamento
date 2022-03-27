<?php 
	include_once("../../body/headCalendarios.php");
	include_once("../Model/modelBancoDeDados.php");
	$idCalendario = $_GET['id'];
	include_once("../Model/modelVerificarCalendario.php");

	$idBlocoCalendario2 = $_GET['idB'];
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

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

	<a href="#"><div class="voltar-pagina-calendario">
		<i class="fas fa-arrow-circle-left"></i>
		<p>Voltar</p>
	</div></a>

	<?php if($totalCalendario[0]['planilha_calendario'] == null){?>
	<section class="filtros-wrapper">

		<div class="filtros-box">
			<p>Tipo: </p>
			<a href="#">Feed</a>
			<a href="#">Story</a>
			<a href="#">Reels</a>
			<a href="#">IGTV</a>
			<a href="#">Youtube</a>
			<a href="#">Blog</a>
		</div>

		<div class="status-box">
			<p>Status: </p>
			<a href="#">1º Produção</a>
			<a href="#">2º Agendado</a>
			<a href="#">3º Publicado</a>
		</div>

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
			if(isset($_POST['dia-do-bloco'])){	

				if($totalCalendario[0]['planilha_calendario'] == null){
					$tipoBloco = $_POST['tipo-bloco'];		
					$temaBloco = $_POST['tema-bloco'];
					//$etapaBloco = $_POST['etapa-bloco'];
					$mesBloco = $_POST['mes-do-bloco'];
				}else{
					$tipoBloco = null;
					$temaBloco = null;
					//$etapaBloco = null;
					$mesBloco = null;
				}

				$diaDoBloco = $_POST['dia-do-bloco'];
				
				$descricaoBloco = $_POST['descricao-bloco'];				

				$editarBlocoCalendario = $pdo->prepare("UPDATE bloco_calendario SET tipo_bloco_calendario = '$tipoBloco', dia_bloco_calendario = '$diaDoBloco', mes_bloco_calendario = '$mesBloco', tema_bloco_calendario = '$temaBloco', descricao_bloco_calendario = '$descricaoBloco' WHERE id_bloco_calendario = '$idBlocoCalendario2'");

				$editarBlocoCalendario->execute();
			}

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
				<div style="cursor: pointer;" class="calendario-box-vazia" >
					<img src="../../images/calendar-icon.png">
				</div>	
			
			<?php 
				}else{ 
			?>
				

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
						}elseif($totalBlocosCalendarios[0]['tipo_bloco_calendario'] == "blog"){
					?>

					background-color: #FBBF24!important;

					<?php }else{ ?>

						background-color: #60A5FA!important;

					<?php }?>
				">	
					<div class="img-close">
						<img src="../../images/edit.png">
						<img src="../../images/close2.png">
					</div>

					<div class="dia-status">					
						<p>
						<?php 
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
						<?php if($totalBlocosCalendarios[0]['producao_bloco_calendario'] != null){?>
						<p><?php echo $totalBlocosCalendarios[0]['producao_bloco_calendario']?></p>
					<?php }?>
					</div>
					<br>
					<?php if($totalCalendario[0]['planilha_calendario'] == null){?>
					<p style="font-weight: bold; font-size: 14px">Tema:</p>
					<p style="font-size: 14px; margin-top: 5px"><?php echo $totalBlocosCalendarios[0]['tema_bloco_calendario']?></p>
					<div class="separador"></div>
					<div class="botao-calendario">
						<button onclick="janelaDescricao(<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>)">Descrição</button>					
					</div>
					<?php }?>

					<?php if($totalCalendario[0]['planilha_calendario'] != null){?>
					<textarea><?php echo $totalBlocosCalendarios[0]['descricao_bloco_calendario']?></textarea>
					<?php }?>
				</div>

			<?php } }?><!-- FIM DO FOR E DO IF -->	

		</div>

		<?php 
				if($i == 1){
					echo "<br><br>";
				}
			} 
		?><!-- FIM DO FOR EXTERNO -->

		<?php if($totalCalendario[0]['planilha_calendario'] == null){?>
			<div class="janela-editar-bloco-calendario">
				<?php 
					$idBlocoCalendario = $_GET['idB'];
					include_once("../Model/modelVerificarBlocoCalendario.php");	
				?>

				<img src="../../images/cancel.png" onclick="fecharJanelaModal(<?php echo $idCalendario?>)">
				<div class="header-janela-modal">
					<h2>Cadastro de novo bloco</h2>
				</div>

				<div class="info-cadastro-bloco-calendario">
					<form method="POST">

						<input name="id-calendario" value="<?php echo $idCalendario?>" hidden>
						<input name="semana-bloco" id="semana-bloco" hidden>
						<input type="text" name="dia-bloco" id="dia-bloco" hidden>

						<div class="info-cadastro-bloco-calendario-box">
							<label>Tipo de bloco:</label><br>
							<div class="tipo-bloco">
								<div>
									<input type="radio" name="tipo-bloco" value="feed" required
									<?php if ($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'feed'){ ?>checked='checked'<?php }?>>
									<label>FEED</label>
								</div>

								<div>
									<input type="radio" name="tipo-bloco" value="story" required
									<?php if ($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'story'){ ?>checked='checked'<?php }?>>
									<label>STORY</label>
								</div>

								<div>
									<input type="radio" name="tipo-bloco" value="reels" required
									<?php if ($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'reels'){ ?>checked='checked'<?php }?>>
									<label>REELS</label>
								</div>

								<div>
									<input type="radio" name="tipo-bloco" value="igtv" required
									<?php if ($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'igtv'){ ?>checked='checked'<?php }?>>
									<label>IGTV</label>
								</div>

								<div>
									<input type="radio" name="tipo-bloco" value="youtube" required
									<?php if ($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'youtube'){ ?>checked='checked'<?php }?>>
									<label>YOUTUBE</label>
								</div>

								<div>
									<input type="radio" name="tipo-bloco" value="blog" required
									<?php if ($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'blog'){ ?>checked='checked'<?php }?>>
									<label>BLOG</label>
								</div>
							</div><!-- FIM TIPO BLOCO -->
						</div><!-- FIM INFO-CADASTRO-BLOCO-CALENDARIO -->
						<br>
						<div class="info-cadastro-bloco-calendario-box dia-mes-bloco">
							<div>
								<label>Dia: </label>
								<input name="dia-do-bloco" type="number" min="1" max="31" required value="<?php echo $totalBlocoCalendario[0]['dia_bloco_calendario']?>">
							</div>

							<div>
								<label>Mês: </label>
								<input name="mes-do-bloco" type="number" min="1" max="12" required value="<?php echo $totalBlocoCalendario[0]['mes_bloco_calendario']?>">
							</div>
						</div>
						<br>
						<div class="info-cadastro-bloco-calendario-box">
							<div class="tema-bloco">
								<label>Tema: </label><br>
								<input name="tema-bloco" type="text" value="<?php echo $totalBlocoCalendario[0]['tema_bloco_calendario']?>" required>
							</div>							
							<br>

							<div class="tema-bloco">
								<label>Descrição: </label><br>
								<textarea name="descricao-bloco" required><?php echo $totalBlocoCalendario[0]['descricao_bloco_calendario']?></textarea>
							</div>							
							<br>
							

							<!--<label>Etapa:</label><br>
							<div class="tipo-bloco">
								<div>
									<input type="radio" name="etapa-bloco" value="1º Produção"
									<?php if (isset($totalBlocoCalendario[0]['producao_bloco_calendario']) && $totalBlocoCalendario[0]['producao_bloco_calendario'] == '1º Produção'){ ?>checked='checked'<?php }?>>
									<label>1º Produção</label>
								</div>

								<div>
									<input type="radio" name="etapa-bloco" value="2º Agendado" 
									<?php if (isset($totalBlocoCalendario[0]['producao_bloco_calendario']) && $totalBlocoCalendario[0]['producao_bloco_calendario'] == '2º Agendado'){ ?>checked='checked'<?php }?>>
									<label>2º Agendado</label>
								</div>

								<div>
									<input type="radio" name="etapa-bloco" value="3º Publicado"
									<?php if (isset($totalBlocoCalendario[0]['producao_bloco_calendario']) && $totalBlocoCalendario[0]['producao_bloco_calendario'] == '3º Publicado'){ ?>checked='checked'<?php }?>>
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
			<div class="janela-editar-bloco-calendario">
				<?php 
					$idBlocoCalendario = $_GET['idB'];
					include_once("../Model/modelVerificarBlocoCalendario.php");	
				?>

				<img src="../../images/cancel.png" onclick="fecharJanelaModal(<?php echo $idCalendario?>)">
				<div class="header-janela-modal">
					<h2>Cadastro de novo bloco</h2>
				</div>

				<div class="info-cadastro-bloco-calendario">
					<form method="POST">

						<input name="id-calendario" value="<?php echo $idCalendario?>" hidden>
						<input name="semana-bloco" id="semana-bloco" hidden>
						<input type="text" name="dia-bloco" id="dia-bloco" hidden>

						
						<br>
						<div class="info-cadastro-bloco-calendario-box dia-mes-bloco">
							<div>
								<label>Dia: </label>
								<input name="dia-do-bloco" type="number" min="1" max="31" required value="<?php echo $totalBlocoCalendario[0]['dia_bloco_calendario']?>">
							</div>
						</div>
						<br>
						<div class="info-cadastro-bloco-calendario-box">	

							<div class="tema-bloco">
								<label>Descrição: </label><br>
								<textarea name="descricao-bloco" required><?php echo $totalBlocoCalendario[0]['descricao_bloco_calendario']?></textarea>
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
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function fecharJanelaModal(idCalendario){
			var idCalendario = idCalendario;

			document.location = 'viewPaginaCalendario.php?id='+idCalendario;	
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
	        } else { 
	            doc = "viewPaginaCalendario.php?id="+idCalendario; 
	        } 

	        window.location.replace(doc);
		}

	</script>

<?php }else{?>
<div class="separador" style="padding: 20px">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php include_once("../../body/footerCalendario.php");?>