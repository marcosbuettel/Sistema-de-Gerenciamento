<?php 
	//PÁGINA PARA MOTRAR TODOS OS PROJETOS CADASTRADOS
	//NÃO ESTÁ EM USO AINDA. POSSIVELMENTE SERÁ USADO NO LUGAR
	//A FUNÇÃO DE SOLICITAÇÕES

	include_once("../../body/headCalendarios.php");
	include_once("../Model/modelBancoDeDados.php");
	$idCalendario = $_GET['id'];
	include_once("../Model/modelVerificarProjeto.php");
	include_once("../Model/modelBlocoProjeto.php");
?>

<?php 
	$idCliente = $totalCalendario[0]['id_cliente'];
	include("../Model/modelCalendarioCliente.php");

	if($_SESSION['nome-cliente'] == $totalCalendarioCliente[0]['nome_cliente'] or $_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){
?>

	<section class="header-calendario">
		
		<div class="name-icon">
			<i class="fas fa-paste" style="font-size: 30px"></i>
			<?php 
				$idCliente = $totalCalendario[0]['id_cliente'];
				include("../Model/modelCalendarioCliente.php");
			?>
			<h2><?php echo $totalCalendario[0]['nome_projeto']?></h2>
		</div>

		<h2><?php echo $totalCalendarioCliente[0]['nome_cliente']?></h2>

	</section><!-- FIM DO HEADER-CALENDARIO -->

	<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
		<a href="viewProjetos.php">
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

	<section class="linha-tempo container" >

		<div class="linha-tempo-wrapper">
		<?php 
			$vetorStatus = array('CALENDÁRIO CRIADO', 'AGUARDANDO APROVAÇÃO', 'CALENDÁRIO APROVADO', 'CARDS DEFINIDOS', 'CRIAÇÃO DE COPY', 'CRIAÇÃO DE DESIGN', 'APROVAÇÃO DO CLIENTE', 'FAZER ALTERAÇÃO', 'AGEND. DO CONTEÚDO', 'ENCAM. PARA RELATÓRIO', 'FINALIZADAS');
			
			for ($i=0; $i < count($vetorStatus); $i++){				
				include('../Model/modelVerificarBlocoProjeto.php');
		?>			
			<div class="box-linha-tempo">

				<?php include('../Controller/controllerStatusLinhaTempo.php');?>

				<h2><?php echo $vetorStatus[$i];?></h2>
				<div class="box-info-linha-tempo">
					<h2>Descrição:</h2>
					<p>
						<?php 
							if(isset($totalBlocoProjeto[0]['id_bloco_projeto'])){
								echo $totalBlocoProjeto[0]['desc_bloco_projeto'];
							}
						?>							
					</p>
					<div class="botoes-linha-tempo">
						<br>
						<?php 
							if(empty($totalBlocoProjeto[0]['id_bloco_projeto'])){
						?>
						<a href="viewCadastroBlocoProjeto.php?id=<?php echo $idCalendario. "&idBP="?><?php echo ($i)?>">Editar</a>
						<?php }else{?>

						<a href="viewEditarBlocoProjeto.php?id=<?php echo $idCalendario. "&idBP="?><?php echo ($i)?>">Editar</a>
						<?php }?>
					</div>
					<br><br><br>
					<div class="data-box-info">
						<hr>
						<p>21/09/2021</p>
					</div>
				</div>				
			</div>
		<?php } ?>
		</div>

	</section><!-- FIM DO LINHA-TEMPO -->

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
	        } else { 
	            doc = "viewPaginaCalendario.php?id="+idCalendario; 
	        } 

	        window.location.replace(doc);
		}

	</script>

<?php }else{?>
	<div class="separador">
		<h2>Desculpe, página não encontrada.</h2>
	</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php include_once("../../body/footerCalendario.php");?>