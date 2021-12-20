<?php 
	//PÁGINA QUE MOSTRA O CONTEÚDO DE CADA BLOCO

	include_once("../../body/headCalendarios.php");
	include_once("../Model/modelBancoDeDados.php");
	$idCalendario = $_GET['id'];
	$_SESSION['idBlocoCalendario'] = $_GET['idB'];
	include_once("../Model/modelVerificarCalendario.php");	
?>

<!--<section class="header-calendario">
	
	<div class="name-icon">
		<img src="../../images/calendar-icon.png">
		<?php 
			$idCliente = $totalCalendario[0]['id_cliente'];
			include("../Model/modelCalendarioCliente.php");
		?>
		<h2><?php echo $totalCalendario[0]['mes_calendario']?></h2>
	</div>

	<h2><?php echo $totalCalendarioCliente[0]['nome_cliente']?></h2>

</section>--><!-- FIM DO HEADER-CALENDARIO -->

<!--<a href="#"><div class="voltar-pagina-calendario">
	<i class="fas fa-arrow-circle-left"></i>
	<p>Voltar</p>
</div></a>-->

<!--<section class="filtros-wrapper">

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

</section>--><!-- FIM DO FILTROS-WRAPPER -->

<!--<section class="calendario-wrapper">

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
					}else{
				?>

				background-color: #FBBF24!important;

				<?php } ?>
			">	
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<div class="img-close">
						<img src="../../images/edit.png">
						<img src="../../images/close2.png">
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
					<button onclick="janelaDescricao(<?php echo $totalBlocosCalendarios[0]['id_bloco_calendario']?>)">Descrição</button>					
				</div>

				<?php 
					include("../Controller/controllerCardAprovado.php");
				?>
			</div>

		<?php } }?>--><!-- FIM DO FOR E DO IF -->	

	<!--</div>

	<?php 
			if($i == 1){
				echo "<br><br>";
			}
		} 
	?>--><!-- FIM DO FOR EXTERNO -->

	<!--<div class="janela-cadastro-bloco-calendario">
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
							<input type="radio" name="tipo-bloco" value="feed">
							<label>FEED</label>
						</div>

						<div>
							<input type="radio" name="tipo-bloco" value="story">
							<label>STORY</label>
						</div>

						<div>
							<input type="radio" name="tipo-bloco" value="reels">
							<label>REELS</label>
						</div>

						<div>
							<input type="radio" name="tipo-bloco" value="igtv">
							<label>IGTV</label>
						</div>

						<div>
							<input type="radio" name="tipo-bloco" value="youtube">
							<label>YOUTUBE</label>
						</div>

						<div>
							<input type="radio" name="tipo-bloco" value="blog">
							<label>BLOG</label>
						</div>
					</div>--><!-- FIM TIPO BLOCO -->
				<!--</div>--><!-- FIM INFO-CADASTRO-BLOCO-CALENDARIO -->
				<!--<br>
				<div class="info-cadastro-bloco-calendario-box dia-mes-bloco">
					<div>
						<label>Dia: </label>
						<input name="dia-do-bloco" type="number" min="1" max="31">
					</div>

					<div>
						<label>Mês: </label>
						<input name="mes-do-bloco" type="number" min="1" max="12">
					</div>
				</div>
				<br>
				<div class="info-cadastro-bloco-calendario-box">
					<div class="tema-bloco">
						<label>Tema: </label><br>
						<input name="tema-bloco" type="text">
					</div>							
					<br>

					<div class="tema-bloco">
						<label>Descrição: </label><br>
						<textarea name="descricao-bloco"></textarea>
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
	</div>-->

	<!-- AQUI COMEÇA A JANELA COM O CONTEÚDO DO BLOCO -->
	<div class="janela-descricao-bloco-calendario  janela-cadastro-bloco-calendario-wrapper">
		<img src="../../images/cancel.png" onclick="fecharJanelaModal(<?php echo $idCalendario?>)" style="top: 8px; right: 10px; width: 30px">
		<div class="header-janela-modal" style="border-radius: 0">
			<h2>Descrição do bloco:</h2>
		</div>

		<?php 
			$idBlocoCalendario = $_GET['idB'];
			$_SESSION['idCalendario'] = $idCalendario;
			$_SESSION['idBlocoCalendario'] = $idBlocoCalendario;
			include("../Model/modelVerificarBlocoCalendario.php"); 
		?>

		<?php 
			//SÓ USUARIO 'ADM' E 'MASTER' PODEM CADASTRAR ARTE
			if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){
		?>

		<div class="cadastrar-arte">
			<form method="POST" action="../Model/modelCadastroArteBloco.php" enctype="multipart/form-data" style="padding: 10px">
				<h3>CADASTRAR ARTE:</h3>
				<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
				<button>Enviar</button>
			</form>
		</div>
		<br>
		<?php }?>

		<div class="descricao-img-instagram-wrapper">			
			<div class="descricao-img-instagram">
				<?php 
					include_once('../Model/modelVerificarImagemBloco.php');
					//if(count($totalImagemBloco) > 0){
				?>

				<?php if($totalBlocoCalendario[0]['tipo_bloco_calendario'] == 'story'){?>
					<div class="img-instagram">						

						<?php if(count($totalImagemBloco) > 1){?>
							<div class="carrossel-instagram" style="overflow-x: scroll;">
						<?php }else{?>
							<div class="carrossel-instagram">
						<?php }?>	

							<?php 
								include_once('../Model/modelVerificarImagemBloco.php');
								if(count($totalImagemBloco) != 0){

								for($i = 0; $i < count($totalImagemBloco); $i++){		
							?>
							
							<img src="<?php echo $totalImagemBloco[$i]['nome_imagem_bloco']?>">
							<?php }}?>
						</div>
					</div>

					

				<?php }else{?>

					<div class="img-instagram">
						
						<div class="img-instagram-header">
							<div class="img-instagram-perfil">
								<i class="fas fa-user-circle"></i>
								<div>
									<p><?php echo $totalCalendarioCliente[0]['nome_cliente']?></p>
									<p>Muriaé</p>
								</div>
							</div>
							<i class="fas fa-ellipsis-v"></i>
						</div>

						<?php if(count($totalImagemBloco) > 1){?>
							<div class="carrossel-instagram" style="overflow-x: scroll;">
						<?php }else{?>
							<div class="carrossel-instagram">
						<?php }?>	

							<?php 
								include_once('../Model/modelVerificarImagemBloco.php');
								if(count($totalImagemBloco) != 0){

								for($i = 0; $i < count($totalImagemBloco); $i++){		
							?>
							
							<!--<div class="qtd-img-instagram">
								<p>1/3</p>
							</div>-->

							<!--<div class="arrow-left arrow-instagram">
								<i class="fas fa-chevron-left"></i>
							</div>

							<div class="arrow-right arrow-instagram">
								<i class="fas fa-chevron-right"></i>
							</div>-->
							
							<img src="<?php echo $totalImagemBloco[$i]['nome_imagem_bloco']?>">

							<?php }}else{?>

							<img src="../../images/postinstagram.png">
							<?php }?>	
						</div>

						<div class="interacao-instagram">
							<div>
								<i class="fas fa-heart"></i>
								<img src="../../images/chat-bubble.png">
								<img src="../../images/direct-instagram.png">
							</div>

							<img src="../../images/ribbon.png">
						</div>

						<div class="likes-instagram">
							<i class="fas fa-heart" style="font-size: 12px"></i>
							<p>500 likes</p>
						</div>

						<div class="legenda-instagram">
							<p><b><?php echo $totalCalendarioCliente[0]['nome_cliente'] ?></b> <?php echo $totalBlocoCalendario[0]['descricao_bloco_calendario']?></p>
						</div>

					</div>
				<?php }?>

				<div class="info-arte">
					
					<div style="display: flex; justify-content: space-between;">
						<h4 style="margin-bottom: 4px">Tema:</h4>
						
						<div class="">
							<span><b>Data:</b> </span>
							<?php if($totalBlocoCalendario[0]['dia_bloco_calendario'] < 10){?>
							<span>0</span>
							<?php }?>
							<span><?php echo $totalBlocoCalendario[0]['dia_bloco_calendario']?></span>
							<span>/</span>
							<?php if($totalBlocoCalendario[0]['mes_bloco_calendario'] < 10){?>
							<span>0</span>
							<?php }?>
							<span><?php echo $totalBlocoCalendario[0]['mes_bloco_calendario']?></span>
							<span>/</span>
							<span><?php echo date("Y")?></span>
						</div>
					</div>

					<div class="titulo-arte">
						<p><?php echo $totalBlocoCalendario[0]['tema_bloco_calendario']?></p>
					</div>

					<div class="textarea-descricao">
						<textarea readonly><?php echo $totalBlocoCalendario[0]['descricao_bloco_calendario']?></textarea>	
					</div>

					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<div class="etapas-aprovacao-wrapper">
						<div class="etapas-aprovacao">
							<p>TEMA</p>							
							<p style="position: relative;left: 15px">ARTE</p>
							<p>LEGENDA</p>
						</div>

						<div class="etapas-aprovacao">
							<?php if($totalBlocoCalendario[0]['tema_aprovado_bloco_calendario'] == 1){?>
							<i class="fas fa-check-circle"></i>
							<?php }else{?>
							<i class="fas fa-circle" style="color: #E5E7EB"></i>
							<?php }?>
							<?php if($totalBlocoCalendario[0]['tema_aprovado_bloco_calendario'] == 1){?>
							<div class="separador-etapas-aprovacao"></div>
							<?php }else{?>
							<div class="separador-etapas-aprovacao-vazio"></div>	
							<?php }?>
							<?php if($totalBlocoCalendario[0]['arte_aprovado_bloco_calendario'] == 1){?>
							<i class="fas fa-check-circle"></i>
							<?php }else{?>
							<i class="fas fa-circle" style="color: #E5E7EB"></i>
							<?php }?>
							<?php if($totalBlocoCalendario[0]['arte_aprovado_bloco_calendario'] == 1){?>
							<div class="separador-etapas-aprovacao-right"></div>
							<?php }else{?>
							<div class="separador-etapas-aprovacao-vazio-right"></div>	
							<?php }?>
							<?php if($totalBlocoCalendario[0]['legenda_aprovado_bloco_calendario'] == 1){?>
							<i class="fas fa-check-circle"></i>
							<?php }else{?>
							<i class="fas fa-circle" style="color: #E5E7EB"></i>
							<?php }?>
						</div>

						<div class="etapas-aprovacao">

							<?php if($totalBlocoCalendario[0]['tema_aprovado_bloco_calendario'] == 0){?>
							<a style="font-size: 10px">AGUARDANDO</a>
							<?php }else{?>
							<a style="background-color: #01BC00; cursor: auto">APROVADO</a>
							<?php }?>	

							<?php if($totalBlocoCalendario[0]['arte_aprovado_bloco_calendario'] == 0){?>
							<a style="font-size: 10px">AGUARDANDO</a>
							<?php }else{?>
							<a style="background-color: #01BC00; cursor: auto">APROVADO</a>
							<?php }?>

							<?php if($totalBlocoCalendario[0]['legenda_aprovado_bloco_calendario'] == 0){?>
							<a style="font-size: 10px">AGUARDANDO</a>
							<?php }else{?>
							<a style="background-color: #01BC00; cursor: auto">APROVADO</a>
							<?php }?>
						</div>
					</div>
					<?php }?>

					<?php if($_SESSION['tipo-usuario'] == 'leitor'){?>
					
					<div class="etapas-aprovacao-mobile" style="display: flex; justify-content: space-between;">
						<div class="etapas-aprovacao-wrapper">
							<div class="etapas-aprovacao">
								<p>TEMA</p>							
								<p style="position: relative;left: 15px">ARTE</p>
								<p>LEGENDA</p>
							</div>

							<div class="etapas-aprovacao">
								<?php if($totalBlocoCalendario[0]['tema_aprovado_bloco_calendario'] == 1){?>
								<i class="fas fa-check-circle"></i>
								<?php }else{?>
								<i class="fas fa-circle" style="color: #E5E7EB"></i>
								<?php }?>
								<?php if($totalBlocoCalendario[0]['tema_aprovado_bloco_calendario'] == 1){?>
								<div class="separador-etapas-aprovacao"></div>
								<?php }else{?>
								<div class="separador-etapas-aprovacao-vazio"></div>	
								<?php }?>
								<?php if($totalBlocoCalendario[0]['arte_aprovado_bloco_calendario'] == 1){?>
								<i class="fas fa-check-circle"></i>
								<?php }else{?>
								<i class="fas fa-circle" style="color: #E5E7EB"></i>
								<?php }?>
								<?php if($totalBlocoCalendario[0]['arte_aprovado_bloco_calendario'] == 1){?>
								<div class="separador-etapas-aprovacao-right"></div>
								<?php }else{?>
								<div class="separador-etapas-aprovacao-vazio-right"></div>	
								<?php }?>
								<?php if($totalBlocoCalendario[0]['legenda_aprovado_bloco_calendario'] == 1){?>
								<i class="fas fa-check-circle"></i>
								<?php }else{?>
								<i class="fas fa-circle" style="color: #E5E7EB"></i>
								<?php }?>
								
							</div>

							<div class="etapas-aprovacao">

								<?php if($totalBlocoCalendario[0]['tema_aprovado_bloco_calendario'] == 0){?>
								<a href="../Model/modelAprovarArteBlocoCalendario.php?id=<?php echo $idCalendario?>&tipoAprovacao=0">APROVAR</a>
								<?php }else{?>
								<a style="background-color: #01BC00; cursor: auto" href="#">APROVADO</a>
								<?php }?>	

								<?php if($totalBlocoCalendario[0]['arte_aprovado_bloco_calendario'] == 0){?>
								<a href="../Model/modelAprovarArteBlocoCalendario.php?id=<?php echo $idCalendario?>&tipoAprovacao=1">APROVAR</a>
								<?php }else{?>
								<a style="background-color: #01BC00; cursor: auto" href="#">APROVADO</a>
								<?php }?>

								<?php if($totalBlocoCalendario[0]['legenda_aprovado_bloco_calendario'] == 0){?>
								<a href="../Model/modelAprovarArteBlocoCalendario.php?id=<?php echo $idCalendario?>&tipoAprovacao=2">APROVAR</a>
								<?php }else{?>
								<a style="background-color: #01BC00; cursor: auto" href="#">APROVADO</a>
								<?php }?>
							</div>
						</div>

						<a href="#" onclick="novoComentario()">
							<div class="box-info-arte" style="background-color: #EAD85B; width: 141px;font-size: 16px; font-weight: bold; position: relative;top: 35%">
								<span>SUGESTÃO</span>
								<i class="far fa-question-circle"></i>
							</div>
						</a>

					</div>

					<div class="aprovar-sugestao">
						<?php //if($totalBlocoCalendario[0]['aprovado_bloco_calendario'] == 1){?>
						<!--<div class="box-info-arte" style="width: 175px;">
							<span>APROVADO</span>
							<i class="far fa-check-circle"></i>
						</div>-->
						<?php //}else{?>

						<!--<a onclick="aprovarBlocoCalendario()" href="../Model/modelAprovarArteBlocoCalendario.php?id=<?php //echo $idCalendario?>">
							<div class="box-info-arte" style="width: 135px;">
								<span>APROVAR</span>
							</div>
						</a>-->
						<?php// }?>

						
					</div>
					<?php }?>
					
					<div style="display: flex; justify-content: space-between;">
						<h3>Comentários:</h3>
						
					</div>
					<div class="comentarios-bloco">					

						<div class="comentario-box">
							<?php 
								include("../Model/modelVerificarComentarioBlocoCalendario.php"); 

								$idUsuarioLogado = $_SESSION['id-usuario-logado'];

								for ($i=0; $i < count($totalComentarioBlocoCalendario); $i++) {
									$idComentario = $totalComentarioBlocoCalendario[$i]['id_comentario_bloco_calendario'];					
							?>

							<br>
							
							<?php 
								if($idUsuarioLogado == $totalComentarioBlocoCalendario[$i]['id_usuario_comentario_bloco_calendario']){
							?>

							<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

							<div class="edit-delete-comentario">				
								<a href="viewEditarComentario.php?id=<?php echo $idCalendario?>&idB=<?php echo $idBlocoCalendario?>&idComentario=<?php echo $idComentario?>"><i class="fas fa-edit" style="color: #60A5FA"></i></a>
								<h3> | </h3>
								<a href="../Model/modelExcluirComentario.php?idComentario=<?php echo $idComentario?>"><i class="fas fa-trash-alt" style="color: red;font-size: 18px; margin-top: 3px"></i></a>	
							</div>
							<?php }?>

							<?php }?>

							<h4><?php echo strtoupper($totalComentarioBlocoCalendario[$i]['usuario_comentario_bloco_calendario'])?></h4>

							<p><?php echo $totalComentarioBlocoCalendario[$i]['descricao_comentario_bloco_calendario']?></p>

							<?php 
								$dataFormatada = explode('-', $totalComentarioBlocoCalendario[$i]['horario_comentario_bloco_calendario']);

								$horarioFormatado = explode(' ', $dataFormatada[2]);

								$dia = $horarioFormatado[0];
								$mes = $dataFormatada[1];
								$ano = $dataFormatada[0];
								
								$hora = $horarioFormatado[1];
							?>

							<p><?php echo $dia."/".$mes."/".$ano. " " . $hora?></p>			

							<?php //include('../Model/modelVerificarImagens.php');?>

							<!--<div class="imagens-comentario">
								<?php //for($j = 0; $j < count($totalImagens); $j++){?>
									<img onclick="aumentarImagem(<?php //echo $idComentario?>)" src="<?php //echo $totalImagens[$j]['nome_imagem_comentario'];?>">
								<?php//}?>	
							</div>-->


							<!-- ANTIGO JEITO DE MOSTRAR A IMAGEM DO COMENTÁRIO
								QUANDO ERA APENAS POSSÍVEL FAZER O UPLOAD DE UMA
								IMAGEM POR VEZ -->
							<?php /*$imgAtual = $totalComentarioBlocoCalendario[$i]['img_comentario_bloco_calendario']?>

							<?php if($imgAtual != null){?>
								<img src="<?php echo $imgAtual?>" onclick="aumentarImagem(<?php echo $i?>)">
							<?php }*/?>

							<!-- ESSA DIV NÃO É MAIS USADA. SERVIA PARA AUMENTAR A IMAGEM CADASTRADA -->
							<div class="imagem-aumentada" id="imgAumentada<?php echo $idComentario?>" style="display: none">
								<div class="header-janela-modal">
									<h2>Imagens do comentário:</h2>
								</div>
								<div class="fechar-imagem-aumentada">
									<img src="../../images/cancel.png" onclick="fecharImagemAumentada(<?php echo $idComentario?>)">
								</div>

								<div class="imagens-por-comentario">
									
									<?php for($j = 0; $j < count($totalImagens); $j++){?>
										<img onclick="aumentarImagem(<?php echo $i?>)" src="<?php echo $totalImagens[$j]['nome_imagem_comentario'];?>">
									<?php }?>
									
								</div>
							</div>

							<div class="separador-preto"></div>

							<?php }?>
						</div><!-- FIM COMENTARIO-BOX -->
					</div><!-- FIM COMENTARIOS-BLOCO -->
					<div class="escrever-novo-comentario">
						<form method="POST" action="../Model/modelCadastroComentarioBloco.php"> 
							<textarea placeholder="Escrever comentário..." name="comentario-bloco" required></textarea>
							<button id="botao-enviar-comentario"><i class="fas fa-paper-plane"></i></button>
							<div class="enviar-comentario">
								<p>ENVIAR</p>
							</div>
						</form>
					</div>
					<br>
					<!--<div class="cadastro-comentario" style="text-align: center">
						<button onclick="novoComentario()">NOVO COMENTÁRIO <i class="fas fa-plus-circle"></i></button>
					</div>-->
				</div>

				
			</div>
		</div>

		<!--<div class="separador-preto"></div>-->
	
		<!--<div class="info-cadastro-bloco-calendario" style="text-align: center">
			<button onclick="novoComentario()">NOVO COMENTÁRIO</button>
		</div>-->
	</div>

	<div class="janela-cadastro-comentario">
		<img src="../../images/cancel.png" onclick="fecharJanelaComentario(<?php echo $idCalendario?>)">
		<div class="header-janela-modal">
			<h2>Novo comentário:</h2>
		</div>

		<div class="adicionar-comentario-bloco">
			<h2>Escreva seu comentário:</h2>
			<br>
			<form method="POST" action="../Model/modelCadastroComentarioBloco.php" enctype="multipart/form-data">
				<textarea name="comentario-bloco" required></textarea>

				<?php 
					if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){
				?>
				
				<!--<input type="checkbox" name="anexar-foto" value="1" onclick="enviarFoto()"> ANEXAR FOTO?

				<br><br>

				<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">-->
				<?php //}else{?>

				<!--<div class="aprovar-card">
					<input type="radio" name="aprovacao" value="1"> Aprovado	
					<input type="radio" name="aprovacao" value="2"> Reprovado
				</div>-->

				<?php }?>
				<div class="info-cadastro-bloco-calendario" style="text-align: center">
					<button>ADICIONAR</button>
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

	function fecharJanelaComentario(id){
		$('.janela-cadastro-comentario').css('display', 'none');	
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

	function novoComentario(){
		$('.janela-cadastro-comentario').css('display', 'block');
	}

	function editarComentario(comentario, idComentario){
		$('.janela-editar-comentario').css('display', 'block');

		document.getElementById('comentario-bloco').value = comentario;

		document.getElementById('idComentario').value = idComentario;
	}

	function atualizarComentario(){
		var idComentario = document.getElementById('idComentario').value;

		window.location.replace("../Model/modelEditarComentarioBloco.php?idComentario="+idComentario);
	}

	function aumentarImagem(idImg){
		$("#imgAumentada"+idImg).toggle( "slow", function(){});

		//$(".imagem-aumentada").toggle( "slow", function(){});

		//$("#fecharImgAumentada"+idImg).toggle( "slow", function(){});
	}

	function fecharImagemAumentada(idImg){
		$("#imgAumentada"+idImg).toggle( "slow", function(){});

		//$("#fecharImgAumentada"+idImg).css( "display", "none");
	}

	//function enviarFoto(){
	//	$('#fileToUpload').toggle( "slow", function(){});
	//}

	function aprovarBlocoCalendario(){
		alert("Arte aprovada!");
	}


	//DIV ONDE FICAM OS COMENTÁRIOS VAI PARA O FIM
	//PARA COMEÇAR MOSTRANDO OS COMENTÁRIOS MAIS ATUAIS
	$('.comentarios-bloco').stop().animate({
	  scrollTop: $('.comentarios-bloco')[0].scrollHeight
	}, 1500);

	//$('.carrossel-instagram').scrollLeft( 300 );

	//FUNÇÃO PARA MOVIMENTAR AS IMAGENS CASO TENHA MAIS DE UMA
	function animatethis(targetElement, speed) {
	    var scrollWidth = $(targetElement).get(0).scrollWidth;
	    var clientWidth = $(targetElement).get(0).clientWidth;
	    $(targetElement).animate({ scrollLeft: scrollWidth - clientWidth },
	    {
	        duration: speed,
	        complete: function () {
	            targetElement.animate({ scrollLeft: 0 },
	            {
	                duration: speed,
	                complete: function () {
	                    animatethis(targetElement, speed);
	                }
	            });
	        }
	    });
	};

	animatethis($('.carrossel-instagram'), 4500);

	$('.carrossel-instagram').mouseover(function(){
		$(".carrossel-instagram").stop();
	});
	
	$('.carrossel-instagram').mouseleave(function(){
		animatethis($('.carrossel-instagram'), 4500);
	});

	$('#botao-enviar-comentario').mouseover(function(){
		$('.enviar-comentario').css('display', 'block');
	});

	$('#botao-enviar-comentario').mouseleave(function(){
		$('.enviar-comentario').css('display', 'none');
	});

</script>

<?php include_once("../../body/footerCalendario.php");?>