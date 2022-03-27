<?php 
	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");		
?>

<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>

	<section class="nav-painel separador">
		
		<ul>		
			<li>Formulários</li>
		</ul>

	</section>

	<section class="botao-cadastro-cliente separador">
		<a href="#" onclick="cadastroCliente()">ESCOLHER ARQUIVO</a>
	</section>

	<section class="clientes-box-wrapper separador">
		
		<table>
			<tr>
				<th></th>
				<th>Data</th>
				<th>Hora</th>
				<th>Nome</th>
				<th>Email</th>
			</tr>
			<?php 
				include_once("../Model/modelVerificaFormulario.php");
				for ($i=0; $i < count($totalFormulario) ; $i++){
					//$idCliente = $totalFormulario[$i]['id_cliente'];			 
			?>

			<tr>
				<td>				
					<div class="botao-editaExclui-cliente">					
						<a href="viewEditarCliente.php?id=<?php echo $idCliente?>">Editar</a>
						<!--<a href="" onclick="confirmarExcluir(<?php echo $idCliente?>)">Excluir</a>-->
					</div>
				</td>

				<td><?php echo $totalFormulario[$i]['data_formulario']?></td>
				<td><?php echo $totalFormulario[$i]['hora_formulario']?></td>
				<td style="min-width: 200px"><?php echo $totalFormulario[$i]['nome_cliente_formulario']?></td>
				<td style="min-width: 200px"><?php echo $totalFormulario[$i]['email_formulario']?></td>		
			</tr>
		
			<?php } ?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<div class="janela-modal-cadastro">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Enviar arquivo</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Controller/controllerUploadArquivo.php" enctype="multipart/form-data">
					<input type="file" name="arquivo-escolhido"><br>
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

		function confirmarExcluir(idCliente){
			var idCliente = idCliente;
	        var doc; 
	        var result = confirm("Confirmar exclusão do cliente?"); 

	        if (result == true) { 
	            doc = "../Model/modelExcluirCliente.php?id="+idCliente; 
	        } else { 
	            doc = "viewClientes.php"; 
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