<?php 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li><a href="">Calendários Cadastrados</a></li>
		</ul>

	</section>

	<section class="botao-cadastro-cliente separador">
		<a href="#">CADASTRAR NOVO CALENDÁRIO</a>
	</section>

	<section class="calendario-box-wrapper separador">
		
		<table>
			<tr>
				<th></th>
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

					$clienteCalendario = $_POST['nome-cliente'];
					include_once("../Model/modelVerificarCliente.php");
					$idCliente = $totalClientes[0]['id_cliente'];				

					$editarCalendario = $pdo->prepare("UPDATE calendario SET mes_calendario = '$mesCalendario', qtd_semanas_calendario = '$semanasCalendario', id_cliente = '$idCliente' WHERE id_calendario = '$idCalendario'");

					$editarCalendario->execute();

					echo "<script>document.location='viewCalendarios.php'</script>";
				}

				for ($i=0; $i < count($totalCalendarios) ; $i++){
					$idCalendario = $totalCalendarios[$i]['id_calendario']; 
			?>

			<tr>
				<td>				
					<div class="botao-editaExclui-cliente botao-pagina-editar">					
						<a href="#">Editar</a>
						<a href="#" onclick="confirmarExcluir(<?php echo $idCalendario?>)">Excluir</a>
					</div>
				</td>

				<td><a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><i class="fas fa-calendar-check" style="font-size: 20px; margin-right: 5px; position: relative; top: 5px"></i><?php echo $totalCalendarios[$i]['mes_calendario']?></a></td>

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

		<div class="janela-modal-editar-calendario">
			<img src="../../images/cancel.png" onclick="fecharJanelaModalEditar()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo calendário</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST">

					<div class="form-box">
						<div>
							<label>Mês do calendário:</label><br>
							<input type="text" value="<?php echo $totalCalendarios[0]['mes_calendario'] ?>" placeholder="Mês do calendário" name="mes-calendario" style="text-align: center; width: 200px"><br>
						</div>

						<div>
							<label>Cliente:</label><br>
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

					<br>

					<div class="form-box">
						<div>
							<label>Número de semanas:</label><br>
							<input type="number" value="<?php echo $totalCalendarios[0]['qtd_semanas_calendario'] ?>" min="1" name="qtd-semanas-calendario" style="text-align: center; padding: 10px!important; width: 80px"><br>
						</div>

						<div>
							<label>Usuário:</label><br>
							<input type="text" name="usuario-calendario" readonly value="<?php echo strtoupper($_SESSION['login'])?>" style="text-align: center; width: 250px"><br>
						</div>
					</div>
					<label>Data de criação:</label><br>
					<input type="text" name="data-criacao-calendario" readonly value="<?php echo $dataAtual?>" style="text-align: center"><br>

					<button>CONFIRMAR</button>
				</form>
			</div>
		</div>	

	</section><!-- FIM DO CLIENTES-BOX-WRAPPER -->

	<script type="text/javascript">
		
		function cadastroCliente(){
			$('.janela-modal-cadastro').css('display', 'block');
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}


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