<?php 
	//PÁGINA PARA EDIÇÃO DO CALENDARIO
	
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Calendários Cadastrados</li>
			<li><a href="#">CADASTRAR NOVO CALENDÁRIO</a></li>
		</ul>

	</section>

	<section class="calendario-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<th>Calendário</th>
				<th>Cliente Referente</th>
				<th>Quantidade de Semanas</th>
				<th>Usuário Responsável</th>
				<th>Data de Criação</th>
			</tr>
			<?php 
				include_once("../Model/modelCalendarios.php");

				if(isset($_POST['mes-calendario'])){
					$idCalendario = $_GET['id'];
					
					$mesCalendario = $_POST['mes-calendario'];
					$semanasCalendario = $_POST['qtd-semanas-calendario'];

					//FAZER EDIÇÃO DE P1 E P2 AQUI
					//PUXAR OS POST'S E FAZER UPDATE

					$p1CopyCalendario = $_POST['p1-copy-calendario'];
					$p1ArteCalendario = $_POST['p1-arte-calendario'];
					$p2CopyCalendario = $_POST['p2-copy-calendario'];
					$p2ArteCalendario = $_POST['p2-arte-calendario'];

					$clienteCalendario = $_POST['nome-cliente'];
					include_once("../Model/modelVerificarCliente.php");
					$idCliente = $totalClientes[0]['id_cliente'];


					$editarCalendario = $pdo->prepare("UPDATE calendario SET mes_calendario = '$mesCalendario', qtd_semanas_calendario = '$semanasCalendario', id_cliente = '$idCliente', p1_copy_calendario = '$p1CopyCalendario', p1_arte_calendario = '$p1ArteCalendario', p2_copy_calendario = '$p2CopyCalendario', p2_arte_calendario = '$p1ArteCalendario' WHERE id_calendario = '$idCalendario'");

					$editarCalendario->execute();

					echo "<script>document.location='viewCalendarios.php'</script>";
				}

				for ($i=0; $i < count($totalCalendarios) ; $i++){
					$idCalendario = $totalCalendarios[$i]['id_calendario'];	
			?>

			<tr>				

				<td><b><a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><?php echo $totalCalendarios[$i]['mes_calendario']?></a></b>
					<div class="primeira-coluna-tabela">				
						<div class="botao-editaExclui-cliente">
							<a href="#"><i class="far fa-eye"></i></a>

							<a href="#"><i class="far fa-folder-open"></i></a>
							<a href="#"><i class="far fa-edit"></i></a>
							<i class="far fa-trash-alt" ></i>
							<!--<a href="#" onclick="confirmarExcluir(<?php echo $idCalendario?>)">Excluir</a>-->
						</div>
					</div>
				</td>

				<?php 
					$idCliente = $totalCalendarios[$i]['id_cliente'];
					include("../Model/modelCalendarioCliente.php");
				?>

				<td><?php echo $totalCalendarioCliente[0]['nome_cliente']?></td>


				<td><?php echo $totalCalendarios[$i]['qtd_semanas_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['usuario_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['data_criacao_calendario']?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-editar-calendario modal-cadastro-calendario janela-modal-geral">
			<?php 
				$idCalendario = $_GET['id'];
				include('../Model/modelVerificarCalendario.php')
			?>
			<img src="../../images/cancel.png" onclick="fecharJanelaModalEditar()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo calendário</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST">

					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Mês do calendário:</label>
								<input type="text" value="<?php echo $totalCalendario[0]['mes_calendario'] ?>" placeholder="Mês do calendário" name="mes-calendario" style="text-align: center; width: 200px">
							</div>

							<div>
								<label>Cliente:</label>
								<select name="nome-cliente">
									<?php 
										include_once("../Model/modelClientes.php");
										$dataAtual = date('d/m/Y');

										for ($i=0; $i < count($totalClientes); $i++){						
									?>
									<option value="<?php echo $totalClientes[$i]['nome_cliente']?>"><?php echo $totalClientes[$i]['nome_cliente']?></option>
									<?php }?><!-- FIM DO FOR DO SELECT -->
								</select>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>P1 Copy:</label>
								<input type="date" name="p1-copy-calendario" required value="<?php echo $totalCalendario[0]['p1_copy_calendario']?>">
							</div>

							<div>
								<label>P1 Arte:</label>
								<input type="date" name="p1-arte-calendario" required value="<?php echo $totalCalendario[0]['p1_arte_calendario']?>"><br>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>P2 Copy:</label>
								<input type="date" name="p2-copy-calendario" required value="<?php echo $totalCalendario[0]['p2_copy_calendario']?>">
							</div>

							<div>
								<label>P2 Arte:</label>
								<input type="date" name="p2-arte-calendario" required value="<?php echo $totalCalendario[0]['p2_arte_calendario']?>"><br>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Número de semanas:</label>
								<input type="number" value="<?php echo $totalCalendario[0]['qtd_semanas_calendario'] ?>" min="1" name="qtd-semanas-calendario" style="text-align: center; padding: 10px!important; width: 80px">
							</div>

							<div>
								<label>Usuário:</label>
								<input type="text" name="usuario-calendario" readonly value="<?php echo strtoupper($_SESSION['login'])?>" style="text-align: center; width: 250px">
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Data de criação:</label>
								<input type="text" name="data-criacao-calendario" readonly value="<?php echo $dataAtual?>" style="text-align: center">
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
		
		$('.janela-modal-cadastro').css('display', 'block');
		$('body').css('background-color', 'rgba(0,0,0,0.5)');
		$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');

		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function editarCliente(){
			$('.janela-modal-editar').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}


		function fecharJanelaModalEditar(){
			document.location = "viewCalendarios.php";
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