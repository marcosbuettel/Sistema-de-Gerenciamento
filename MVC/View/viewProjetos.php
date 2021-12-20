<?php 
	//PÁGINA PARA VISUALIZAR TODOS OS CALENDARIOS 
	//CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include('../Controller/controllerFormatarData.php');
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
			<li>Projetos</li>
			<li><a href="#" onclick="cadastroProjeto(1)">NOVO PROJETO</a></li>
		</ul>

	</section>

	<section class="calendario-box-wrapper separador tabela-box-wrapper">

		<div class="projetos-wrapper">

			<?php for($i = 0; $i < count($totalProjetos); $i++){?>
				<div class="projetos-box">
					<div class="projetos-box-header">
						<h2 onclick="abrirListaProjetos(<?php echo $totalProjetos[$i]['id_projeto']?>)"><i class="fas fa-sort-down"></i> <?php echo $totalProjetos[$i]['nome_projeto']?></h2>

						<div>
							<h2>Total de tarefas: 10</h2>
							<h2>Atrasadas: 2 <i class="fas fa-exclamation-circle" style="color: red"></i></h2>
						</div>
						
						<button onclick="cadastroProjeto(2)"><i class="fas fa-plus-circle"></i> NOVA TAREFA</button>
						
					</div>

					<div class="projetos-box-lista" id="projetos-lista<?php echo $totalProjetos[$i]['id_projeto']?>">
						<table>
							<tr>
								<th>Tarefa</th>
								<th>Descrição</th>
								<th>Prazo</th>
								<th>Responsável</th>
							</tr>
						</table>
					</div>				
				</div>
			<?php }?><!-- FIM DO FOR 'i' -->

		</div>

		<div class="janela-modal-cadastro modal-cadastro-projeto janela-modal-geral" id="janela-modal-1">
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

		<div class="janela-modal-cadastro modal-cadastro-projeto janela-modal-geral" id="janela-modal-2">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de nova tarefa</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastrarTarefaProjeto.php">

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

		//FUNÇÃO PARA FECHAR A JANELA DE CADASTRO DO CALENDARIO
		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function abrirListaProjetos(id){
			$('#projetos-lista'+id).slideToggle();
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