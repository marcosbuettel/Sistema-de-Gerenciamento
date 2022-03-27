<?php 
	//PÁGINA PARA VISUALIZAR AS TAREFAS REFERENTE AOS BLOCOS 
	//CADASTRADOS EM CADA CALENDÁRIO
	
	$idTarefa = $_GET['id'];

	//include_once("MVC/Controller/controllerAcesso.php");
	include_once('../Controller/controllerFormatarData.php');
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
	include_once("../Model/modelTarefaSelecionada.php");
	include_once("../Model/modelVerificarComentariosTarefa.php");
	
?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="tarefa-selecionada separador">
		
		<div class="info-tarefa-selecionada">
			
			<div style="display: flex; justify-content: space-between;">
				<h2><?php echo $totalTarefas[0]['titulo_tarefa'] ?></h2>
				<h3>Prazo: <?php echo formatarData($totalTarefas[0]['prazo_tarefa']) ?></h3>
			</div>

			<br>
			<p><?php echo $totalTarefas[0]['nome_cliente_tarefa'] ?></p>

			<?php if($totalTarefas[0]['status_tarefa'] == 'aguardando-aprovacao'){ ?>

				<p><b>Status:</b> AGUARDANDO APROVAÇÃO</p>

			<?php }else if($totalTarefas[0]['status_tarefa'] == 'enviar-cliente'){ ?>

				<p><b>Status:</b> ENVIAR PARA O CLIENTE</p>

			<?php }else if($totalTarefas[0]['status_tarefa'] == 'finalizado'){ ?>

				<p><b>Status:</b> FINALIZADO</p>

			<?php }else{ ?>

				<p><b>Status:</b> ANDAMENTO</p>

			<?php } ?>			

			<br>

			<h3>DESCRIÇÃO TAREFA</h3>
			<p style="margin-top: 10px; font-size: 18px"><?php echo $totalTarefas[0]['descricao_tarefa'] ?></p>

			<br>

			<a href="<?php echo $totalTarefas[0]['link_img_tarefa'] ?>" target="_blank">ANEXO DA TAREFA</a>

			<?php if($totalTarefas[0]['status_tarefa'] == "aguardando-aprovacao"){?>
				
				<button style="margin-left: 20px;background-color: black; color: white; padding: 10px 20px;	font-size: 20px; font-weight: bold; cursor: pointer; border: none;" onclick="aprovarTarefa(<?php echo $idTarefa ?>)">APROVAR <i class="fa-solid fa-thumbs-up"></i></button>

			<?php } ?>

			<?php if($totalTarefas[0]['status_tarefa'] == "enviar-cliente"){?>
				
				<button style="margin-left: 20px;background-color: black; color: white; padding: 10px 20px;	font-size: 20px; font-weight: bold; cursor: pointer; border: none;" onclick="finalizarTarefa(<?php echo $idTarefa ?>)">FINALIZAR <i class="fa-solid fa-circle-check"></i></button>

			<?php } ?>

		</div><!-- FIM INFO-TAREFA-SELECIONADA -->

		<div class="comentarios-tarefa-selecionada">
			<div style="width: 100%; background-color: black; padding: 10px 20px; color: white">
				<h3>COMENTÁRIOS</h3>
			</div>

			<div class="comentarios-tarefa-box">
				<div class="comentarios-tarefa">
					<?php for($i = 0; $i < count($totalComentarios); $i++){?>

					<div style="display: flex; justify-content: space-between;">
						<div>
							<h3><?php echo strtoupper($totalComentarios[$i]['usuario_comentario_tarefa']) ?></h3>
							<p><b>DATA:</b> <?php echo formatarData($totalComentarios[$i]['data_comentario_tarefa']) ?></p>
						</div>

						<div>
							<i onclick="editarComentario(<?php echo $totalComentarios[$i]['id_comentario_tarefa'] ?>);" class="fa-solid fa-pen-to-square" style="margin-right: 10px; cursor: pointer"></i>

							<i onclick="removerComentario(<?php echo $totalComentarios[$i]['id_comentario_tarefa'] ?>,<?php echo $totalComentarios[$i]['id_tarefa'] ?>)" class="fa-solid fa-trash-can" style="margin-right: 20px; cursor: pointer;"></i>
						</div>

					</div>

					<div class="textarea-comentario-tarefa" id="textarea-comentario-tarefa<?php echo $totalComentarios[$i]['id_comentario_tarefa'] ?>">
						<form method="POST" action="../Model/modelEditarComentarioTarefa.php?idC=<?php echo $totalComentarios[$i]['id_comentario_tarefa'] ?>&idT=<?php echo $totalComentarios[$i]['id_tarefa'] ?>">
							<textarea name="comentario-tarefa"><?php echo $totalComentarios[$i]['descricao_comentario_tarefa'] ?></textarea>
							<button>EDITAR</button>
						</form>
					</div>

					<p style="margin-top: 10px"><?php echo $totalComentarios[$i]['descricao_comentario_tarefa'] ?></p>

					<div style="width: 100%; background-color: #D3D3D3; height: 1px; margin-bottom: 20px"></div>

					<?php }?>
				</div>

				<form method="post" action="../Model/modelCadastrarComentarioTarefa.php?id=<?php echo $idTarefa ?>">
					<div class="enviar-comentario-tarefa">
						<textarea name="descricao-comentario"></textarea>
						<button><i class="fa-solid fa-paper-plane"></i></button>
					</div>
				</form>
			</div>
		</div><!-- FIM COMENTARIOS-TAREFA-SELECIONADA -->

	</section>
		

	<script type="text/javascript">

		function removerComentario(idComentario, idTarefa){
			var idComentario = idComentario;
			var idTarefa = idTarefa;

	        var result = confirm("Confirmar exclusão do comentário?"); 

	        if (result == true) { 
	            document.location = "../Model/modelExcluirComentarioTarefa.php?idT="+idTarefa+"&idC="+idComentario; 
	        }	
		}

		function editarComentario(idComentario){
			$('#textarea-comentario-tarefa'+idComentario).css('display', 'block');
		}

		function aprovarTarefa(idTarefa){
			var idTarefa = idTarefa;

	        var result = confirm("Aprovar?"); 

	        if (result == true) { 
	            document.location = "../Model/modelMudarStatusTarefa.php?id="+idTarefa+"&tipo=1"; 
	        }	
		}

		function finalizarTarefa(idTarefa){
			var idTarefa = idTarefa;

	        var result = confirm("Finalizar tarefa?"); 

	        if (result == true) { 
	            document.location = "../Model/modelMudarStatusTarefa.php?id="+idTarefa+"&tipo=2"; 
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