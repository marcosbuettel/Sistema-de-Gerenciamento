<?php 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Calendários Cadastrados</li>
		</ul>

	</section>

	<section class="botao-cadastro-cliente separador">
		<a href="#" onclick="cadastroCalendario()">CADASTRAR NOVO CALENDÁRIO</a>
	</section>

	<section class="calendario-box-wrapper separador">
		
		<table>
			<tr>
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					<th></th>
				<?php }?>
				<th>Calendário</th>
				<th>Cliente Referente</th>
				<th>Quantidade de Semanas</th>
				<th>Usuário Responsável</th>
				<th>Data de Criação</th>
			</tr>
			<?php 
				include_once("../Model/modelCalendarios.php");
				for ($i=0; $i < count($totalCalendarios) ; $i++){
					$idCalendario = $totalCalendarios[$i]['id_calendario']; 
			?>

			<?php if($totalCalendarios[$i]['arquivado_calendario'] != 1 && $totalCalendarios[$i]['planilha_calendario'] == null){?>

			<tr>
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>	
				<td>
					<div class="botao-editaExclui-cliente">
						<a href="../Model/modelArquivarCalendario.php?id=<?php echo $idCalendario?>">Arquivar</a>
						<a href="viewEditarCalendario.php?id=<?php echo $idCalendario?>">Editar</a>
						<a href="#" onclick="confirmarExcluir(<?php echo $idCalendario?>)">Excluir</a>
					</div>
				</td>
				<?php }?>

				<td><a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><i class="fas fa-calendar-check" style="font-size: 30px; margin-right: 10px; position: relative; top: 5px"></i><?php echo $totalCalendarios[$i]['mes_calendario']?></a></td>

				<?php 
					$idCliente = $totalCalendarios[$i]['id_cliente'];
					include("../Model/modelCalendarioCliente.php");
				?>

				<td><?php echo $totalCalendarioCliente[0]['nome_cliente']?></td>

				<td><?php echo $totalCalendarios[$i]['qtd_semanas_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['usuario_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['data_criacao_calendario']?></td>
			</tr>
		
			<?php } }?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo calendário</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastroCalendario.php">

					<div class="form-box">
						<div>
							<label>Mês do calendário:</label><br>
							<input type="text" placeholder="Mês do calendário" name="mes-calendario" style="text-align: center; width: 200px"><br>
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
							<input type="number" min="1" name="qtd-semanas-calendario" style="text-align: center; padding: 10px!important; width: 80px"><br>
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
	        var result = confirm("Confirmar exclusão do calendário?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirCalendario.php?id="+idCalendario; 
	        } else { 
	            doc = "viewCalendarios.php"; 
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