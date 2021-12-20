<?php 
	//PÁGINA PARA EDITAR O USUÁRIO
	
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");
	$idUsuarioEscolhido = $_GET['id'];
	include_once('../Model/modelVerificarUsuario.php');		
?>

<?php if($_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Usuários Cadastrados</li>
			<li><a href="#" onclick="cadastroCliente()">CADASTRAR NOVO USUÁRIO</a></li>
		</ul>

	</section>

	<section class="clientes-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
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
				<td><?php echo $totalUsuarios[$i]['nome_usuario']?>
					<div class="botao-editaExclui-cliente2 primeira-coluna-tabela">					
						<a href="#"><i class="far fa-edit"></i></a>
						<i class="far fa-trash-alt"></i>
					</div>
				</td>
				<td><?php echo $totalUsuarios[$i]['nome_cliente']?></td>
				<td><?php echo $totalUsuarios[$i]['senha_usuario']?></td>
				<td><?php echo $totalUsuarios[$i]['tipo_usuario']?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-editar-usuario modal-cadastro-usuario janela-modal-geral">			
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo usuário</h2>
			</div>

			<div class="info-cadastro-cliente info-cadastro-usuario">
				<form method="POST" action="../Model/modelEditarUsuario.php?idU=<?php echo $idUsuarioEscolhido?>" enctype="multipart/form-data">	

					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Nome:</label>
								<input type="text" placeholder="Nome do usuário" name="nome-usuario" required value="<?php echo $totalUsuarioEscolhido[0]['nome_usuario']?>">
							</div>

							<div>
								<label>Senha:</label>
								<input type="text" placeholder="Senha" name="senha-usuario" required value="<?php echo $totalUsuarioEscolhido[0]['senha_usuario']?>">
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Foto de perfil:</label><br>	
								<input type="file" name="fileToUpload2" id="fileToUpload2">
							</div>
							<div >
								<?php if($totalUsuarioEscolhido[0]['imagem_usuario'] != null){?>
									<div class="editar-foto-usuario" style="background-image: url('<?php echo $totalUsuarioEscolhido[0]['imagem_usuario']?>')">
									</div>
								<?php }else{?>
								<img src="../../images/profile-black.png" style="width: 70px; height: 70px">
								<?php }?>							
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Tipo:</label><br>
								<select name="tipo-usuario">
									<option value="master">Master</option>
									<option value="adm">ADM</option>
									<option value="leitor">Leitor</option>
								</select>
							</div>

							<div>
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
			document.location = 'viewUsuarios.php';
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