<?php 
	//PÁGINA PARA MOSTRAR TODOS OS PROJETOS CADASTRADOS
	
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Projetos Cadastrados</li>
		</ul>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		<a href="#" onclick="cadastroCalendario()">CADASTRAR NOVO PROJETO</a>
	</section>-->

	<section class="calendario-box-wrapper separador">
		
		<table>
			<tr>
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<th></th>
				<?php }?>
				<th>Projeto</th>
				<th>Cliente</th>				
				<th>Status</th>
				<th>Data de Criação</th>
			</tr>
			<?php 
				include_once("../Model/modelProjetos.php");
				for ($i=0; $i < count($totalCalendarios) ; $i++){
					$idProjeto = $totalCalendarios[$i]['id_projeto'];
					$idClienteProjeto = $totalCalendarios[$i]['id_cliente'];
			?>

			<tr>
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
				<td>	

					<div class="botao-editaExclui-cliente">					
						<a href="viewEditarCalendario.php?id=<?php echo $idProjeto?>">Editar</a>
						<a href="#" onclick="confirmarExcluir(<?php echo $idProjeto?>)">Excluir</a>
					</div>
				</td>
				<?php }?>

				<?php 
					include("../Model/modelClienteProjeto.php");				 
				?>

				<td><a href="viewPaginaProjeto.php?id=<?php echo $idProjeto?>"><i class="fas fa-paste" style="font-size: 30px; margin-right: 10px; position: relative; top: 5px"></i><?php echo $totalCalendarios[$i]['nome_projeto']?></a></td>
				<td><?php echo $totalClientes[0]['nome_cliente']?></td>
				<td><?php echo strtoupper($totalCalendarios[$i]['status_projeto'])?></td>
				<td><?php echo $totalCalendarios[$i]['data_inicial_projeto']?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo projeto</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastroProjeto.php">

					<div class="form-box">
						<div>
							<label>Tipo de projeto:</label><br>
							<select name="tipo-projeto">
								<option value="MARKETING">Marketing</option>
								<option value="ECOMMERCE">E-commerce</option>
							</select><br>
						</div>

						<div>
							<label>Cliente:</label><br>
							<select name="nome-cliente">
								<?php 
									include_once("../Model/modelClientes.php");
									$dataAtual = date('d/m/Y');

									for ($i=0; $i < count($totalClientes); $i++){						
								?>
								<option value="<?php echo $totalClientes[$i]['id_cliente']?>"><?php echo $totalClientes[$i]['nome_cliente']?></option>
								<?php }?><!-- FIM DO FOR DO SELECT -->
							</select>
						</div>
					</div>

					<br>

					<div class="form-box">
						<div>
							<label>Status:</label><br>
							<textarea name="status-projeto" style="width: 300px; height: 100px; padding: 5px"></textarea><br>
						</div>
					</div>

					<label>Data de criação:</label><br>
					<input type="text" name="data-criacao-projeto" readonly value="<?php echo $dataAtual?>" style="text-align: center"><br>

					<button>CONFIRMAR</button>
				</form>
			</div>
		</div>	

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		
		function cadastroCalendario(){
			$('.janela-modal-cadastro').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}


		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function confirmarExcluir(idCalendario){
			var idCalendario = idCalendario;
	        var doc; 
	        var result = confirm("Confirmar exclusão do projeto?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirProjeto.php?id="+idCalendario; 
	        } else { 
	            doc = "viewProjetos.php"; 
	        } 

	        window.location.replace(doc);
		}
	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>