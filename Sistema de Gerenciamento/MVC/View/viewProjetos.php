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

	<style type="text/css">
		th:nth-child(2), td:nth-child(2),th:nth-child(3), td:nth-child(3),th:nth-child(1), td:nth-child(1){
			min-width: 200px!important;
		}

		th:nth-child(1), td:nth-child(1){
			min-width: 200px!important;
		}
	</style>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA
		OS USUARIOS TIPO 'LEITOR' TEM
		SUA PRÓPRIA PÁGINA SEPARADA PARA 
		VER SEUS PROJETOS -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	<!-- TROCAR ESSE IF PELO DO USUARIO LOGADO OU MARCADO NO PROJETO -->
	<section class="nav-painel separador">
		
		<ul>		
			<li>Projetos</li>
			<li><a href="#" onclick="cadastroProjeto(0)">NOVO PROJETO</a></li>
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

			<?php 
				for($w = 0; $w < 5; $w++){

					$tituloTipoProjeto = array('IDENTIDADE VISUAL', 'MKT PERFORMANCE', 'MKT ORGÂNICO', 'INSTITUCIONAL', 'ECOMMERCE');

					$tipoProjeto = array('id-visual', 'mkt-per', 'mkt-org', 'institucional', 'ecommerce');
			?>
				<br>
				<h2><?php echo $tituloTipoProjeto[$w] ?></h2>
				<hr>
				<br>

			<?php 		
				
				include('../Controller/controllerExibirProjetos.php');
				}
			?>
			
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
							
						</div>

						<div class="campos-formulario">
							<div>
								<label>Prazo:</label>
								<input type="date" name="prazo-projeto">
							</div>
							
						</div>

						<div class="campos-formulario">

							<div>
								<label>Tipo:</label><br>
								<input type="radio" name="tipo-projeto" value="id-visual"><label>ID Visual</label>
								<input type="radio" name="tipo-projeto" value="mkt-org"><label>MKT - Orgânico</label>
								<input type="radio" name="tipo-projeto" value="mkt-per"><label>MKT - Performance</label>
								<input type="radio" name="tipo-projeto" value="ecommerce"><label>Ecommerce</label><br>
								<input type="radio" name="tipo-projeto" value="institucional"><label>Institucional</label>
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
			//$('#janela-modal-'+id).css('display', 'block');
			$('#janela-modal-'+id).slideToggle();
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function editaProjeto(id){
			//$('#janela-modal-edit'+id).css('display', 'block');
			$('#janela-modal-edit'+id).slideToggle();
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		function editarTarefa(id){
			//$('#janela-editar-tarefa-'+id).css('display', 'block');
			$('#janela-editar-tarefa-'+id).slideToggle();
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

		function exibirEditarTarefa(id){
			$('#editar-tarefa'+id).css('display', 'block');
		}

		$('.fa-edit').mouseleave(function(){
			$('.editar-tarefa').css('display', 'none');	
		});

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
	            window.location.replace(doc);
	        }	        
		}

		function arquivarProjeto(id){
			var idProjeto = id;
	        var doc; 
	        var result = confirm("Arquivar projeto?"); 

	        if (result == true) { 
	            doc = "../Model/modelArquivarProjeto.php?id="+idProjeto; 
	            window.location.replace(doc);
	        }	        
		}


		function finalizarTarefa(id){
			var result = confirm("Finalizar tarefa?"); 

			if (result == true) { 

				var id_projeto = id;
				$.ajax({
					method: 'post',
					data:{'id': id_projeto},
					url: '../Model/modelFinalizarTarefaProjeto.php'
				}).done(function(){
					$('#botao-finalizar-tarefa'+id_projeto).css('display', 'none');
					$('#botao-tarefa-finalizada'+id_projeto).css('display', 'inline');

					$('#icone-andamento'+id_projeto).css('display', 'none');
					$('#icone-finalizada'+id_projeto).css('display', 'inline');
					//$('#enviar-producao'+id_solicitacao_cliente).css('display', 'none');
				});
			}
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