<?php 
	//PÁGINA PARA EXIBIR OS USUÁRIOS CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Usuários Cadastrados</li>
			<li><a href="#" onclick="cadastroCliente()">CADASTRAR NOVO USUÁRIO</a></li>
		</ul>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		
	</section>-->

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
				<td>
					<?php if($totalUsuarios[$i]['imagem_usuario'] != null){?>	
						<div class="imagem-perfil-usuario" style="background-image: url('<?php echo $totalUsuarios[$i]['imagem_usuario'] ?>')"></div>
						
					<?php }else{?>
						<img style="border-radius: 50%; width: 30px; top: 10px;right: 5px; position: relative" src="../../images/profile-black.png">
					<?php }?>
					<?php echo $totalUsuarios[$i]['nome_usuario']?>
					<div class="botao-editaExclui-cliente2 primeira-coluna-tabela">					
						<a href="viewEditarUsuario.php?id=<?php echo $idUsuario?>"><i onmouseover="exibeFuncao('editar', <?php echo $idUsuario?>)" class="far fa-edit"></i>
							<div class="icones-acao" id="editar<?php echo $idUsuario?>">EDITAR</div>
						</a>
						<i onmouseover="exibeFuncao('excluir', <?php echo $idUsuario?>)" class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idUsuario?>)">
							<div class="icones-acao" id="excluir<?php echo $idUsuario?>">EXCLUIR</div>
						</i>
					</div>
				</td>
				<td><?php echo $totalUsuarios[$i]['nome_cliente']?></td>
				<td><?php echo $totalUsuarios[$i]['senha_usuario']?></td>
				<td><?php echo $totalUsuarios[$i]['tipo_usuario']?></td>
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro modal-cadastro-usuario janela-modal-geral">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo usuário</h2>
			</div>

			<div class="info-cadastro-cliente info-cadastro-usuario">
				<form method="POST" action="../Model/modelCadastroUsuario.php" enctype="multipart/form-data">		
					
					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Nome:</label>
								<input type="text" placeholder="Nome do usuário" name="nome-usuario" required>
							</div>
							
							<div>
								<label>Senha:</label>
								<input type="text" placeholder="Senha" name="senha-usuario" required>
							</div>
							
						</div>

						<div class="campos-formulario">
							<div>
								<label>Foto de perfil:</label><br>					
								<input type="file" name="fileToUpload2" id="fileToUpload2">
							</div>

							<img src="../../images/profile-black.png">
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

		function exibeFuncao(funcao, id){
			if(funcao == 'view'){
				$('#view'+id).css('display', 'block');
			}else if(funcao == 'arquivar'){
				$('#arquivar'+id).css('display', 'block');
			}else if(funcao == 'editar'){
				$('#editar'+id).css('display', 'block');
			}else{
				$('#excluir'+id).css('display', 'block');
			}	
		}

		$('.botao-editaExclui-cliente2 i').mouseleave(function(){
			$('.icones-acao').css('display', 'none');
		});

	</script>

<?php }else{?>
<div class="separador">
	<h2>Desculpe, página não encontrada.</h2>
</div>
<?php }?><!-- FIM DO IF DO TIPO DE USUARIO LOGADO -->

<?php 
	include_once("../View/viewFooter.php");	
?>