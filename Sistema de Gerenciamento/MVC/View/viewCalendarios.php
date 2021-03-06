<?php 
	//PÁGINA PARA VISUALIZAR TODOS OS CALENDARIOS 
	//CADASTRADOS NO SISTEMA

	include_once("../View/viewHead.php");
	include_once("../Model/modelBancoDeDados.php");	
	include('../Controller/controllerFormatarData.php');
?>

	<!-- APENAS OS USUARIOS DO TIPO 'ADM' E 'MASTER'
		TERÃO ACESSO A ESSA PÁGINA
		OS USUARIOS TIPO 'LEITOR' TEM
		SUA PRÓPRIA PÁGINA SEPARADA PARA 
		VER SEUS CALENDARIOS -->
<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
	
	<section class="nav-painel separador">
		
		<ul>		
			<li>Calendários Cadastrados</li>
			<li><a href="#" onclick="cadastroCalendario()">CADASTRAR NOVO CALENDÁRIO</a></li>
		</ul>

	</section>

	<!--<section class="botao-cadastro-cliente separador">
		
	</section>-->

	<section class="calendario-box-wrapper separador tabela-box-wrapper">
		
		<table class="tabela-box">
			<tr>
				<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>
					
				<?php }?>
				<th>Calendário</th>
				<th>Cliente Referente</th>
				<th>Quantidade de Semanas</th>
				<th>P1 Copy</th>
				<th>P1 Arte</th>
				<th>P2 Copy</th>
				<th>P2 Arte</th>
				<th>Usuário Responsável</th>
				<th>Data de Criação</th>				
			</tr>
			<?php 
				include_once("../Model/modelCalendarios.php");
				for ($i=0; $i < count($totalCalendarios) ; $i++){
					$idCalendario = $totalCalendarios[$i]['id_calendario']; 
			?>

			<!-- CONDIÇÃO PARA VER APENAS OS CALENDARIOS QUE AINDA
				NÃO FORAM ARQUIVADOS
				TAMBÉM SÃO SEPARADOS OS CALENDÁRIOS QUE IRÃO 
				APARECER SOMENTE NA PÁGINA DE 'GERENCIAR PRAZOS' -->

			<?php if($totalCalendarios[$i]['arquivado_calendario'] != 1 && $totalCalendarios[$i]['planilha_calendario'] == null){?>

			<tr>
				<!-- CONDIÇÃO PARA APARECER OS BOTÕES DE EDITAR E
					EXCLUIR O CALENDÁRIO APENAS PARA OS USUARIOS
					'ADM' E 'MASTER' -->				

				<td style="min-width: 250px!important"><b><a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><!--<i class="fas fa-calendar-check" style="font-size: 30px; margin-right: 10px; position: relative; top: 5px"></i>--><?php echo $totalCalendarios[$i]['mes_calendario']?></a></b>
					<?php if($_SESSION['tipo-usuario'] == 'adm' or $_SESSION['tipo-usuario'] == 'master'){?>	
				<div class="primeira-coluna-tabela">
					<div class="botao-editaExclui-cliente">


						<!-- 
							SE 'ativo_calendario' == 1 
							O CALENDÁRIO ESTÁ DESATIVADO
							SENÃO
							O CALENDÁRIO ESTÁ ATIVO
						-->
						<?php if($totalCalendarios[$i]['ativo_calendario'] == 1){ ?>

						
							<i id="botao-ativar-calendario<?php echo $idCalendario?>" onmouseover="exibeFuncao('ativar', <?php echo $idCalendario?>)" class="far fa-calendar-check botao-ativar-calendario" onclick="confirmarAtivar(<?php echo $idCalendario?>, 'noHide')"></i>
							<div class="icones-acao" id="ativar<?php echo $idCalendario?>">ATIVAR</div>
						
							<i id="botao-desativar-calendario-hide<?php echo $idCalendario?>" onmouseover="exibeFuncao('desativar', <?php echo $idCalendario?>)" class="fas fa-calendar-check botao-desativar-calendario-hide" onclick="confirmarDesativar(<?php echo $idCalendario?>, 'hide')"></i>
							<div class="icones-acao" id="desativar<?php echo $idCalendario?>">DESATIVAR</div>
						
								
						<?php }else{?>

							
							<i id="botao-desativar-calendario<?php echo $idCalendario?>" onmouseover="exibeFuncao('desativar', <?php echo $idCalendario?>)" class="fas fa-calendar-check botao-desativar-calendario" onclick="confirmarDesativar(<?php echo $idCalendario?>, 'noHide')"></i>
							<div class="icones-acao" id="desativar<?php echo $idCalendario?>">DESATIVAR</div>
						
							<i id="botao-ativar-calendario-hide<?php echo $idCalendario?>" onmouseover="exibeFuncao('ativar', <?php echo $idCalendario?>)" class="far fa-calendar-check botao-ativar-calendario-hide" onclick="confirmarAtivar(<?php echo $idCalendario?>, 'hide')"></i>
							<div class="icones-acao" id="ativar<?php echo $idCalendario?>">ATIVAR</div>
						
								
						<?php }?>




						<a href="viewPaginaCalendario.php?id=<?php echo $idCalendario?>"><i onmouseover="exibeFuncao('view', <?php echo $idCalendario?>)" class="far fa-eye"></i>
							<div class="icones-acao" id="view<?php echo $idCalendario?>">VISUALIZAR</div>
						</a>
						
						<i onmouseover="exibeFuncao('arquivar', <?php echo $idCalendario?>)" class="fas fa-file-export" onclick="confirmarArquivar(<?php echo $idCalendario?>)"></i>
							<div class="icones-acao" id="arquivar<?php echo $idCalendario?>">ARQUIVAR</div>
						
						<a href="viewEditarCalendario.php?id=<?php echo $idCalendario?>"><i onmouseover="exibeFuncao('editar', <?php echo $idCalendario?>)" class="far fa-edit"></i>
							<div style="left: 50px;" class="icones-acao" id="editar<?php echo $idCalendario?>">EDITAR</div>
						</a>
						<i onmouseover="exibeFuncao('excluir', <?php echo $idCalendario?>)" class="far fa-trash-alt" onclick="confirmarExcluir(<?php echo $idCalendario?>)">
							<div class="icones-acao" id="excluir<?php echo $idCalendario?>">EXCLUIR</div>
						</i>
						<!--<a href="#" onclick="confirmarExcluir(<?php echo $idCalendario?>)">Excluir</a>-->
					</div>
				</div>
				<?php }?>
				
				<?php if($totalCalendarios[$i]['ativo_calendario'] == 1){ ?>
				
				<h4 style="margin-top: 10px" id="texto-desativado<?php echo $idCalendario?>">(DESATIVADO)</h4>
				<h4 style="margin-top: 10px" class="texto-ativado-hide" id="texto-ativado-hide<?php echo $idCalendario?>">(ATIVADO)</h4>

				<?php }else{?>

				<h4 style="margin-top: 10px"id="texto-ativado<?php echo $idCalendario?>">(ATIVADO)</h4>
				<h4 style="margin-top: 10px" class="texto-desativado-hide" id="texto-desativado-hide<?php echo $idCalendario?>">(DESATIVADO)</h4>

				<?php }?>

				</td>

				<?php 
					$idCliente = $totalCalendarios[$i]['id_cliente'];
					include("../Model/modelCalendarioCliente.php");
				?>

				<td><?php echo $totalCalendarioCliente[0]['nome_cliente']?></td>

				<td><?php echo $totalCalendarios[$i]['qtd_semanas_calendario']?></td>				

				<?php if(isset($totalCalendarios[$i]['p1_copy_calendario'])){?>
					<td><?php echo formatarData($totalCalendarios[$i]['p1_copy_calendario']);
						?></td>
					<td><?php echo formatarData($totalCalendarios[$i]['p1_arte_calendario']);
						?></td>
					<td><?php echo formatarData($totalCalendarios[$i]['p2_copy_calendario']);
						?></td>
					<td><?php echo formatarData($totalCalendarios[$i]['p2_arte_calendario']);
						?></td>
				<?php }else{?>

					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<?php }?>
				
				<td><?php echo $totalCalendarios[$i]['usuario_calendario']?></td>
				<td><?php echo $totalCalendarios[$i]['data_criacao_calendario']?></td>
			</tr>
		
			<?php } }?><!-- FIM DO FOR CLIENTES-BOX -->
		</table>

		<!-- JANELA QUE SE ABRE QUANDO VAI CADASTRAR UM
			NOVO CALENDARIO	-->
		<div class="janela-modal-cadastro modal-cadastro-calendario janela-modal-geral">
			<img src="../../images/cancel.png" onclick="fecharJanelaModal()">
			<div class="header-janela-modal">
				<h2>Cadastro de novo calendário</h2>
			</div>

			<div class="info-cadastro-cliente">
				<form method="POST" action="../Model/modelCadastroCalendario.php">

					<div class="campos-formulario-container">
						<div class="campos-formulario">
							<div>
								<label>Mês do calendário:</label>
								<input type="text" placeholder="Mês do calendário" name="mes-calendario" style="text-align: center; width: 200px">
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
								<input type="date" name="p1-copy-calendario" required><br>		
							</div>

							<div>
								<label>P1 Arte:</label>
								<input type="date" name="p1-arte-calendario" required><br>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>P2 Copy:</label>
								<input type="date" name="p2-copy-calendario" required><br>		
							</div>

							<div>				
								<label>P2 Arte:</label>
								<input type="date" name="p2-arte-calendario" required><br>
							</div>
						</div>

						<div class="campos-formulario">
							<div>
								<label>Número de semanas:</label>
								<input type="number" min="1" name="qtd-semanas-calendario" style="text-align: center; padding: 10px!important; width: 80px">
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
		
		//FUNCÃO QUE FAZ ABRIR A JANELA DE CADASTRO DO CALENDÁRIO
		function cadastroCalendario(){
			//$('.janela-modal-cadastro').css('display', 'block');
			$('.janela-modal-cadastro').slideToggle();
			$('body').css('background-color', 'rgba(0,0,0,0.5)');
			$('tr:nth-child(2n)').css('background-color', 'rgba(255,255,255,0.5)');
		}

		//FUNÇÃO PARA FECHAR A JANELA DE CADASTRO DO CALENDARIO
		function fecharJanelaModal(){
			$('.janela-modal-cadastro').css('display', 'none');	
			$('body').css('background-color', '#F5F5F5');
			$('tr:nth-child(2n)').css('background-color', 'white');
		}

		//FUNÇÃO PARA DAR UM 'ALERT' PARA O USUARIO, PARA ELE
		//CONFIRMAR SE VAI EXCLUIR O CALENDARIO
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

		function confirmarArquivar(idCalendario){
			var idCalendario = idCalendario;
	        var doc; 
	        var result = confirm("Arquivar calendário?"); 

	        if (result == true) { 
	            doc = "../Model/modelArquivarCalendario.php?id="+idCalendario; 
	            window.location.replace(doc);
	        }	        
		}

		function confirmarAtivar(idCalendario, status){
			var idCalendario = idCalendario;
			var status = status;
	        var doc; 
	        var result = confirm("Ativar calendário?"); 

	        if (result == true) { 
				$.ajax({
					method: 'post',
					data:{'id': idCalendario},
					url: '../Model/modelAtivarCalendario.php'
				}).done(function(){
					if(status == 'noHide'){
						
						$('#botao-ativar-calendario'+idCalendario).css('display', 'none');
						$('#botao-desativar-calendario-hide'+idCalendario).slideToggle();

						$('#texto-desativado'+idCalendario).css('display', 'none');
						$('#texto-ativado-hide'+idCalendario).slideToggle();

					}else{
						
						$('#botao-ativar-calendario-hide'+idCalendario).css('display', 'none');
						$('#botao-desativar-calendario'+idCalendario).slideToggle();

						$('#texto-desativado-hide'+idCalendario).css('display', 'none');
						$('#texto-ativado'+idCalendario).slideToggle();
					}
				});
	        }	        
		}

		function confirmarDesativar(idCalendario, status){
			var idCalendario = idCalendario;
			var status = status;
	        var doc; 
	        var result = confirm("Desativar calendário?"); 

	        if (result == true) { 
				$.ajax({
					method: 'post',
					data:{'id': idCalendario},
					url: '../Model/modelDesativarCalendario.php'
				}).done(function(){
					if(status == 'noHide'){
						
						$('#botao-desativar-calendario'+idCalendario).css('display', 'none');
						$('#botao-ativar-calendario-hide'+idCalendario).slideToggle();

						$('#texto-ativado'+idCalendario).css('display', 'none');
						$('#texto-desativado-hide'+idCalendario).slideToggle();			

					}else{
						
						$('#botao-desativar-calendario-hide'+idCalendario).css('display', 'none');
						$('#botao-ativar-calendario'+idCalendario).slideToggle();

						$('#texto-ativado-hide'+idCalendario).css('display', 'none');
						$('#texto-desativado'+idCalendario).slideToggle();									
					}
				});
	        }	        
		}

		function exibeFuncao(funcao, id){
			if(funcao == 'view'){
				$('#view'+id).css('display', 'block');
			}else if(funcao == 'arquivar'){
				$('#arquivar'+id).css('display', 'block');
			}else if(funcao == 'editar'){
				$('#editar'+id).css('display', 'block');
			}else if(funcao == 'ativar'){
				$('#ativar'+id).css('display', 'block');
			}else if(funcao == 'desativar'){
				$('#desativar'+id).css('display', 'block');
			}else{
				$('#excluir'+id).css('display', 'block');
			}	
		}

		$('.botao-editaExclui-cliente i').mouseleave(function(){
			$('.icones-acao').css('display', 'none');
		});
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