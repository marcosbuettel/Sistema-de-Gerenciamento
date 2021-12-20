<?php 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Usuários Cadastrados</li>
		</ul>

	</section>

	<section class="botao-cadastro-cliente separador">
		<a href="#" onclick="cadastroCliente()">CADASTRAR NOVO USUÁRIO</a>
	</section>

	<section class="clientes-box-wrapper separador">
		
		<table>
			<tr>
				<th></th>
				<th>Nome do Usuário</th>
				<th>Nome do Cliente</th>
				<th>Senha</th>
				<th>Tipo</th>
			</tr>
			<?php 
				include_once("../Model/modelUsuarios.php");
				for ($i=0; $i < count($totalUsuarios) ; $i++){
					$idUsuario = $totalUsuarios[$i]['id_usuario'];				 
			?>

			<tr>
				<td>				
					<div class="botao-editaExclui-cliente2">					
						<a href="viewEditarUsuario.php?id=<?php echo $idUsuario?>">Editar</a>
						<a href="#" onclick="confirmarExcluir(<?php echo $idUsuario?>)">Excluir</a>
					</div>
				</td>

				<td><?php echo $totalUsuarios[$i]['nome_usuario']?></td>
				<td><?php echo $totalUsuarios[$i]['nome_cliente']?></td>
				<td><?php echo $totalUsuarios[$i]['senha_usuario']?></td>
				<td><?php echo $totalUsuarios[$i]['tipo_usuario']?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo usuário</h2>
			</div>

			<div class="info-cadastro-cliente info-cadastro-usuario">
				<form method="GET" action="../Model/modelCadastroUsuario.php">
					<label>Nome do usuário:</label><br>
					<input type="text" placeholder="Nome do usuário" name="nome-usuario" required>
					<br>
					<label>Senha:</label><br>
					<input type="text" placeholder="Senha" name="senha-usuario" required>
					<br>

					<label>Cliente:</label><br>
					<select name="nome-cliente">
						<option><?php echo ' '?></option>
						<?php 
							include_once("../Model/modelClientes.php");
							for($i = 0; $i < count($totalClientes); $i++){
						?>
						<option value="<?php echo $totalClientes[$i]['nome_cliente']?>"><?php echo $totalClientes[$i]['nome_cliente']?></option>
						<?php }?>
					</select>
					<br><br>
					<label>Tipo:</label><br>
					<select name="tipo-usuario">
						<option value="master">Master</option>
						<option value="adm">ADM</option>
						<option value="leitor">Leitor</option>
					</select>

					<br><br>
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
			$('.janela-modal-editar').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		function confirmarExcluir(idUsuario){
			var idUsuario = idUsuario;
	        var doc; 
	        var result = confirm("Confirmar exclusão do usuário?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirUsuario.php?id="+idUsuario; 
	        } else { 
	            doc = "viewUsuarios.php"; 
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